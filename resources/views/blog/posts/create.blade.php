@extends('layouts.app')

@section('content')
    <div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            @auth
            <form method="POST" action="{{ route('post.store') }}">
            @csrf
                @for($i = 0; $i < $count; $i++)
                    <input placeholder="text" type="text" name="body">
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