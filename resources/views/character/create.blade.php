@extends('layouts.app')

@section('content')
<div class="container-sm mt-5">
    <div class="row">
        <div class="col-lg-8">
            <h1>СОЗДАНИЕ ПЕРСОНАЖА</h1>
            <form method="POST" action="{{ route('character.store') }}" enctype="multipart/form-data">
                @csrf
                <h3>Данные которые будут показаны в index</h3>
                <div class="mb-2">
                    <input name="name" id="name" type="text" class="form-control" minlength="3" placeholder="Name" required>
                    <input name="mainBody" placeholder="Основная информация на 100 слов" type="textarea" class="form-control" minlength="3" required>
                    <div class="card mb-2 ">
                        <div class="card-body p-2">
                            <input name="mainPhoto" type="file" class="form-control-file" minlength="3" required>
                        </div>
                    </div>
                </div>
                <h3>Данные которые будут показаны в show</h3>
                @for($k = 0; $k < count($count); $k++) 
                @if($count[$k]=='title' ) 
                <div class="mb-2">
                    <input name="title[{{$k}}]" placeholder="Мини заголовок для инфы как в википедии" type="textarea" class="form-control" minlength="3" required>
                </div>
                @elseif(($count[$k] == 'body'))
                <div class="mb-2">
                    <input name="body[{{$k}}]" placeholder="Текст к Title" type="text" class="form-control" minlength="3" required>
                </div>
                @elseif(($count[$k] == 'photo'))
                <div class="card mb-2">
                    <div class="card-body p-2">
                        <input name="photo[{{$k}}]" placeholder="Выберите файл" type="file" class="form-control-file" required>
                    </div>
                </div>
                @endif
                @endfor
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
            <!-- форма добавление + 1 title -->
            <form method="GET" action="{{ route('count.countCharacterIncrement') }}">
                @csrf
                <input type="hidden" name="textNameForTitle" value="title">
                @foreach($count as $key)
                <input type="hidden" name="count[]" value="{{ $key }}">
                @endforeach
                <button type="submit" class="btn btn-outline-primary">добавить title</button>
            </form>
            <!-- форма добавление + 1 body -->
            <form method="GET" action="{{ route('count.countCharacterIncrement') }}">
                @csrf
                <input type="hidden" name="textNameForBody" value="body">
                @foreach($count as $key)
                <input type="hidden" name="count[]" value="{{ $key }}">
                @endforeach
                <button type="submit" class="btn btn-outline-primary">добавить текст к title</button>
            </form>
            <!-- форма добавление + 1 photo -->
            <form method="GET" action="{{ route('count.countCharacterIncrement') }}">
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
@endsection