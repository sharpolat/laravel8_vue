@extends('layouts.app')

@section('content')
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            @auth
            <form method="POST" action="{{ route('post.store') }}">
            @csrf
                {{ $count = 0 }}
                @for($i = 0; $i < $count; $i++)
                <input name=" body[{{ $i }}]"
                        id="{{ $i }}"
                        type="text"
                        class="form-control"
                        minlength="3"
                        required>
                @endfor
                <button type="submit">отправить</button>
            </form>
            @endauth
            </div>
            <div class="col-lg-4">
                adsfafds
            </div>
        </div>
    </div>
@endsection