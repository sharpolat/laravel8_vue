@extends('layouts.app')

@section('content')
@auth
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            <h1>СОЗДАНИЕ ПОСТА</h1>
            <h4>(я разделил создание поста и персонажа так как возможно буду использовать эту же страницу и для создания поста стороними людьми)</h4>
            <form  action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>Text
                        <input name="body"
                                type="text"
                                class="form-control"
                                minlength="3"
                                required>
                    </div>
                <div>Photo
                        <input name="photo"
                                type="file"
                                class="form-control"
                                minlength="3"
                                required>
                    </div>
                <button type="submit">Опубликовать</button>
            </form>   
            <div class="col-lg-4">
                
            </div>
        </div>
    </div>
    @endauth   
@endsection