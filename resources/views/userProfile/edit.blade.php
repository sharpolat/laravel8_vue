@extends('layouts.app')
@section('content')
<div class="row py-5 px-4">
    <div class="col-md-5 mx-auto">
        <form  method="POST" action="{{ route('profile.update', $user->id) }}" class="was-validated" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя">
            </div>
            <div class="form-group">
                <label for="about_me">О себе</label>
                <textarea type="text" class="form-control" id="about_me" name="about_me" placeholder="О себе" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="profile_photo_path">Загрузить аватарку</label>
                <input type="file" class="form-control-file" id="id_image" name="profile_photo_path">
            </div>
            <div id="image-box" class="image-container"></div>
    <button class="btn btn-outline-info" id="crop-btn" style="width: 100%; margin-top: 10px; display: none;" type="button">обрезать</button>
    <button class="btn btn-outline-info" id="confirm-btn" style="width: 100%; margin-top: 10px;" type="submit">изменить</button>
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
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                    </div>
                @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
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
