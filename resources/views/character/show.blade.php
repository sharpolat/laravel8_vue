@extends('layouts.app')

@section('content')
<!-- Page content-->
<div class="container-sm mt-5">
            <div class="row" >
                
                <div class="col-lg-8">
                    <div class="card mb">
                        <h3 class="card-header">{{ $characterData->name }}</h3>
                        
                        <div class="container">
                            <article class="row single-post mt-3 no-gutters">
                                <div class="col-lg-12">
                                    <div class="image-wrapper float-right">
                                    <img src="/image/{{ $characterData->photo }}" width="150px" height="150" class="rounded image-wrapper">
                                    </div>
                                    <div class="single-post-content-wrapper">
                                    @auth
                                    @if(Auth::user()->is_admin == 1)
                                        <form method="POST" action="{{ route('character.update', $characterData->id) }}">
                                        @method('PATCH')    
                                        @csrf
                                            <input type="hidden" name="photo" value="{{ $characterData->photo }}">
                                            <input type="hidden" name="is_main_character" value="{{ $characterData->is_main_character }}">
                                            <textarea name="body" placeholder="Введите Текст" class="ck_editor_txt" id="ckeditor">{{ $characterData->body }}</textarea>
                                            <button type="submit">изменить</button>
                                        </form>
                                    @else
                                    {!! $characterData->body !!}
                                    @endif
                                    @endauth
                                    @guest 
                                    {!! $characterData->body !!}
                                    @endguest
                                    
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                        <div class="container mx-0 px-0">
                            <article class="row single-post mt-3 no-gutters">
                                <div class="col-lg-12">
                                @foreach($characterData->characterShow as $key)
                                @if(isset($key->title))
                                <h3 class="card-header">{!! $key->title !!}</h3>
                                @endif
                                @if(isset($key->photo))
                                    <div class="image-wrapper float-left pr-3">
                                    <img src="/image/{{ $key->photo }}" width="130px" height="100" class="rounded image-wrapper">
                                    </div>
                                @endif
                                @if(isset($key->body))
                                    <div class="single-post-content-wrapper">
                                    @auth
                                    @if(Auth::user()->is_admin == 1)
                                        <form method="POST" action="{{ route('character.update', $key->id) }}">
                                        @method('PATCH')    
                                        @csrf
                                            <textarea name="body" placeholder="Введите Текст" class="ck_editor_txt" id="ckeditor">{{ $key->body }}</textarea>
                                            <button type="submit">изменить</button>
                                        </form>
                                    @else
                                    {!! $key->body !!}
                                    @endif
                                    @endauth
                                    @guest 
                                    {!! $key->body !!}
                                    @endguest
                                    
                                    </div>
                                @endif
                                @endforeach
                                </div>
                            </article>
                        </div>
                </div>
                
                <!-- Side widgets-->
                <div class="col-lg-4">
                <div class="card mb-4">
                        <div class="card-header">Так же может быть интересно</div>
                        <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                    @foreach($chracterRandNames as $key)
                                      <li><a href="{{ route('character.show', $key->id) }}">{{$key->name}}</a></li>
                                    @endforeach
                                    </ul> 
                            </div>
                        </div>
                    </div>
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