@extends('layouts.app')

@section('content')
@auth
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            <h1>СОЗДАНИЕ ПОСТА</h1>
            <h4>(я разделил создание поста и персонажа так как возможно буду использовать эту же страницу и для создания поста сторонними людьми)</h4>
            <form  action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-2">
                    <input name="title"
                            id="title"
                            type="text"
                            class="form-control"
                            placeholder="Заголовок"
                            value="{{ old('title') }}">
                </div>
                <div class="mb-2">
                    <input name="tags"
                            id="tags"
                            type="text"
                            class="form-control"
                            placeholder="Теги"
                            value="{{ old('tags') }}">
                </div>
                <div>
                    <input name="view_count"
                            id="view_count"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 400) }}">
                </div>
                <div>
                    <input name="post_type_id"
                            id="post_type_id"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 19) }}">
                </div>
                <div>
                    <input name="user_id"
                            id="user_id"
                            class="form-control"
                            type="hidden"
                            value="{{ Auth::user()->id }}">
                </div>
                <div>
                    <input name="comment_count"
                            id="comment_count"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 40) }}">
                </div>
                
                @for($k = 0; $k < count($count); $k++)
                    @if($count[$k] == 'text')
                    <div class="mb-2">
                        <textarea name="body[{{$k}}]"
                                placeholder="Введите Текст"
                                class="ck_editor_txt"
                                id="ckeditor"
                                >{{ old('body.'.$k) }}</textarea>
                    </div>
                    
                    @elseif(($count[$k] == 'photo'))
                    <div class="card mb-2 ">
                        <div class="card-body  p-2 m-2.">
                            <input name="photo[{{$k}}]"
                                    placeholder="Выберите файл"
                                    type="file"
                                    class="form-control-file">
                        </div>
                    </div>
                    @endif
                @endfor

                <input name="post_id"
                        id="post_id"
                        type="hidden"
                        class="form-control"
                        value="{{ $post_id->id }}">
                <!-- add new input field -->
                <input type="hidden" name="textNameForText" value="text">
                <input type="hidden" name="textNameForPhoto" value="photo">
                @foreach($count as $key)
                <input type="hidden" name="count[]" value="{{ $key }}">
                @endforeach
                <button type="submit" name="textIncrement" value="textIncrement" class="btn btn-outline-primary">добавить текст</button>
                <button type="submit" name="photoIncrement" value="photoIncrement" class="btn btn-outline-primary">добавить фото</button>
                <button type="submit" name="submitAction" value="Submit">Опубликовать</button>
                <button type="submit" name="previewAction" value="Preview">Предпросмотр(не работает еще)</button>
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
            <div class="col-lg-4">
                <a href="{{ route('character.create') }}">
                    <button type="button" class="btn btn-outline-primary">ссылка создания персонажа</button>
                </a>  
                <!-- форма добавление + 1 text -->
                
            </div>
        </div>
    </div>
    @endauth


    
        
    
@endsection

@section('scripts')
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
        for (var i = 0; i < allEditors.length; ++i) {
          ClassicEditor.create(allEditors[i]);
        }
</script>
@endsection