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
                <input type="file" class="form-control-file" id="profile_photo_path" name="profile_photo_path">
            </div>
            <button class="btn btn-outline-primary mt-3" type="submit">Изменить</button>
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
