@extends('layouts.app')

@section('content')
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
                    <div class="card mb-2 ">
                        <div class="card-body p-2">
                            <input name="mainPhoto" type="file" class="form-control-file">
                        </div>
                    </div>
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
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <input name="photo[{{$k}}]" placeholder="Выберите файл" type="file" class="form-control-file">
                    </div>
                </div>
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
                
                <button type="submit">опубликовать</button>
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
        <!-- форма добавление + 1 title -->

    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>
@endsection