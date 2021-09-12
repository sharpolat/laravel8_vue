@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('loreContent.store') }}">
            @csrf
                <h6>Пиши гребанный title</h6>
                <p> <input placeholder="Title" name="title"></p>
                <input name="user_id" type="hidden" value='{{ Auth::user()->id }}'>
                <button class="btn btn-outline-primary mt-2" type="submit">Добавить</button>
            </form>
        </div>
    </div>
</div>
@endsection