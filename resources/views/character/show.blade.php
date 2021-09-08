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
                                    <div class="image-wrapper float-right pr-3">
                                    <img src="/image/{{ $characterData->photo }}" width="200px" height="200" class="rounded image-wrapper">
                                    </div>
                                    <div class="single-post-content-wrapper">
                                    {!! $characterData->body !!}
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
                                    {!! $key->body !!}
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