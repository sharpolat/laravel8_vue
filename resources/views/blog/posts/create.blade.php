@extends('layouts.app')

@section('content')
@auth
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            
            <form method="POST" action="{{ route('post.store') }}">
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
                @for($i = 0; $i < $count; $i++)
                <div>Text
                <input name="body[{{ $i }}]"
                        id="{{ $i }}"
                        type="text"
                        class="form-control"
                        minlength="3"
                        required>
                </div>
                @endfor
                <input name="post_id"
                        id="post_id"
                        type="hidden"
                        class="form-control"
                        value="{{ $post_id->id }}">
                <button type="submit">отправить</button>
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

             <!-- эксперементы гыыы -->
             <div id="app-5">
                <example-component></example-component>
            </div>

            </div>
        </div>
    </div>
    @endauth


    
        
    
@endsection