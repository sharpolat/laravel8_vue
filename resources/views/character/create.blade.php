@extends('layouts.app')

@section('content')
@if(Auth::user()->is_admin == 1)
<div class="container-sm mt-5">
    <div class="row">
        <div class="col-lg-8">
            <h1>СОЗДАНИЕ ПЕРСОНАЖА</h1>
            @if (Session::has('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
            @endif
            <form method="POST" action="{{ route('character.store') }}" enctype="multipart/form-data">
                @csrf
                <h3>Данные которые будут показаны в index</h3>
                
                <div class="mb-2">
                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Name">
                    <textarea name="mainBody" placeholder="Основная информация на 100 слов" type="textarea" class="ck_editor_txt" id="ckeditor">{{ old('mainBody') }}</textarea>    
                        <input name="mainPhoto" id="id_image" type="file" class="form-control-file">
                </div>
                
                <div class="form-check">
                    <input name="mainCharacter" type="checkbox" class="form-check-input">
                    <label class="form-check-label">Главный персонаж???</label>
                </div>
                <h3>Данные которые будут показаны в show</h3>
                @for($k = 0; $k < count($count); $k++) 
                @if($count[$k]=='title' ) <div class="mb-2">
                    <textarea name="title[{{$k}}]" placeholder="Мини заголовок для инфы как в википедии" type="textarea" class="ck_editor_txt" id="ckeditor">{{ old('title.'.$k) }}</textarea>
                </div>
                @elseif(($count[$k] == 'body'))
                <div class="mb-2">
                    <textarea name="body[{{$k}}]" placeholder="Текст к Title" class="ck_editor_txt" id="ckeditor">{{ old('body.'.$k) }}</textarea>
                </div>
                @elseif(($count[$k] == 'photo'))
                        <input name="photo[{{$k}}]"  type="file" class="form-control-file">
                @endif
                @endfor
                <input type="hidden" name="textNameForTitle" value="title">
                <input type="hidden" name="textNameForBody" value="body">
                <input type="hidden" name="textNameForPhoto" value="photo">
                @foreach($count as $key)
                <input type="hidden" name="count[]" value="{{ $key }}">
                @endforeach
                <button type="submit" name="titleAdd" value="titleAdd" class="btn btn-outline-primary">1. добавить title</button>
                <button type="submit" name="imageAdd" value="imageAdd" class="btn btn-outline-primary">2. добавить изображение</button>
                <button type="submit" name="textAdd" value="textAdd" class="btn btn-outline-primary">3. добавить основной текст</button>
                <div class="form-group">
                
                <button class="btn btn-outline-info" id="confirm-btn" style="width: 100%; margin-top: 10px;" type="submit">опубликовать</button>
                </div>
            </form>

        @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="col-lg-4">
    <div id="image-box" class="image-container"></div>
    <button class="btn btn-outline-info" id="crop-btn" style="width: 100%; margin-top: 10px; display: none;" type="button">обрезать</button>
    </div>
</div>
</div>
@endif
@endsection

@section('scripts')
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }


    // cropperjs
    // image-box is the id of the div element that will store our cropping image preview
    const imagebox = document.getElementById('image-box')
    // crop-btn is the id of button that will trigger the event of change original file with cropped file.
    const crop_btn = document.getElementById('crop-btn')
    // id_image is the id of the input tag where we will upload the image
    const input = document.getElementById('id_image')

    // When user uploads the image this event will get triggered
    input.addEventListener('change', () => {
        // Getting image file object from the input variable
        const img_data = input.files[0]
        // createObjectURL() static method creates a DOMString containing a URL representing the object given in the parameter.
        // The new object URL represents the specified File object or Blob object.
        const url = URL.createObjectURL(img_data)

        // Creating a image tag inside imagebox which will hold the cropping view image(uploaded file) to it using the url created before.
        imagebox.innerHTML = `<img src="${url}" id="image" style="width:100%;">`

        // Storing that cropping view image in a variable
        const image = document.getElementById('image')

        // Displaying the image box
        document.getElementById('image-box').style.display = 'block'
        // Displaying the Crop buttton
        document.getElementById('crop-btn').style.display = 'block'
        // Hiding the Post button
        document.getElementById('confirm-btn').style.display = 'none'

        // Creating a croper object with the cropping view image
        // The new Cropper() method will do all the magic and diplay the cropping view and adding cropping functionality on the website
        // For more settings, check out their official documentation at https://github.com/fengyuanchen/cropperjs
        const cropper = new Cropper(image, {
            autoCropArea: 1,
            viewMode: 1,
            scalable: false,
            zoomable: false,
            movable: false,
            minCropBoxWidth: 100,
            minCropBoxHeight: 100,
        })

        // When crop button is clicked this event will get triggered
        crop_btn.addEventListener('click', () => {
            // This method coverts the selected cropped image on the cropper canvas into a blob object
            cropper.getCroppedCanvas().toBlob((blob) => {

                // Gets the original image data
                let fileInputElement = document.getElementById('id_image');
                // Make a new cropped image file using that blob object, image_data.name will make the new file name same as original image
                let file = new File([blob], img_data.name, {
                    type: "image/*",
                    lastModified: new Date().getTime()
                });
                // Create a new container
                let container = new DataTransfer();
                // Add the cropped image file to the container
                container.items.add(file);
                // Replace the original image file with the new cropped image file
                fileInputElement.files = container.files;

                // Hide the cropper box
                document.getElementById('image-box').style.display = 'none'
                // Hide the crop button
                document.getElementById('crop-btn').style.display = 'none'
                // Display the Post button
                document.getElementById('confirm-btn').style.display = 'block'

            });
        });
    });
</script>

@endsection