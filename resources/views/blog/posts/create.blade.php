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
                <div>Заголовок
                    <input name="title"
                            id="title"
                            type="text"
                            class="form-control"
                            minlength="3"
                            placeholder="Заголовок"
                            required>
                </div>
                <div>Теги
                    <input name="tags"
                            id="tags"
                            type="text"
                            class="form-control"
                            minlength="3"
                            placeholder="Теги"
                            required>
                </div>
                <div>
                    <input name="view_count"
                            id="view_count"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 400) }}"
                            required>
                </div>
                <div>
                    <input name="post_type_id"
                            id="post_type_id"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 19) }}"
                            required>
                </div>
                <div>
                    <input name="user_id"
                            id="user_id"
                            class="form-control"
                            type="hidden"
                            value="{{ Auth::user()->id }}"
                            required>
                </div>
                <div>
                    <input name="comment_count"
                            id="comment_count"
                            class="form-control"
                            type="hidden"
                            value="{{ rand(0, 40) }}"
                            required>
                </div>
                @for($k = 0; $k < count($count); $k++)
                    @if($count[$k] == 'text')
                    <div>Text
                        <input name="body[{{$k}}]"
                                
                                type="text"
                                class="form-control"
                                minlength="3"
                                required>
                    </div>
                    @elseif(($count[$k] == 'photo'))
                    <div>Photo
                        <input name="photo[{{$k}}]"
                                type="file"
                                class="form-control"
                                minlength="3"
                                required>
                    </div>
                    @endif
                @endfor

                <input name="post_id"
                        id="post_id"
                        type="hidden"
                        class="form-control"
                        value="{{ $post_id->id }}">
                <button type="submit">Опубликовать</button>
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
                <a href="{{ route('character.create') }}">
                    <button type="button" class="btn btn-outline-primary">ссылка создания персонажа</button>
                </a>  
                <!-- форма добавление + 1 text -->
                <form method="GET" action="{{ route('count.countIncrement') }}">
                    @csrf
                    <input type="hidden" name="textNameForText" value="text">
                    @foreach($count as $key)
                    <input type="hidden" name="count[]" value="{{ $key }}">
                    @endforeach
                    <button type="submit" class="btn btn-outline-primary">добавить текст</button>
                </form>
                <!-- форма добавление + 1 photo -->
                <form method="GET" action="{{ route('count.countIncrement') }}">
                    @csrf
                    <input type="hidden" name="textNameForPhoto" value="photo">
                    @foreach($count as $key)
                    <input type="hidden" name="count[]" value="{{ $key }}">
                    @endforeach
                    <button type="submit" class="btn btn-outline-primary">добавить фото</button>
                </form>
            </div>
        </div>
    </div>
    @endauth


    
        
    
@endsection