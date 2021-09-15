@extends('layouts.app')
@section('content')
@if(Auth::user()->is_admin == 1)
<form  action="{{ route('imagePage.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-2 ">
                <div class="card-body  p-2 m-2.">
                <label for="image">Загрузите изображение</label>
                    <input name="image" id="image"
                        placeholder="Выберите файл"
                        type="file"
                        class="form-control-file">
                </div>
            </div>
    <button type="submit">Добавить фото</button>
                
</form>
@endif
@endsection