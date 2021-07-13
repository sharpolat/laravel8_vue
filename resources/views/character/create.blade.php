@extends('layouts.app')

@section('content')
<div class="container-sm mt-5">
        <div class="row">
            <div class="col-lg-8">
            <h1>СОЗДАНИЕ ПЕРСОНАЖА</h1>
            <form method="POST" action="{{ route('character.store') }}">
            @csrf
                
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
                
            </div>
        </div>
    </div>
@endsection