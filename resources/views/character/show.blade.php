@extends('layouts.app')

@section('content')
<!-- Page content-->
<div class="container-sm mt-5">
            <div class="row" >
                
                <div class="col-lg-8">
                    <div class="card mb">
                        <h3 class="card-header">{{ $characterData->name }}</h3>
                        <div class="card-body">
                            <h5 class="card-title">Инфа поотм добавлю</h5>
                            <h6 class="card-subtitle text-muted">Их мир откуда, раса(нужно добавить в бд character)</h6>
                        </div>
                        <div class="p-0 m-0"><img src="/image/{{ $characterData->photo }}" width="200px" class="img-fluid"> </div>
                        
                        
                    </div>
                    @foreach($characterData->characterShow as $key)
                    <div class="card">
                        <div class="card-body">
                            @if(isset($key->title))
                                <h5 class="card-title">{{$key->title}}</h5>
                            @elseif(isset($key->body))
                                <p class="card-text">{{$key->body}}</p>
                            @else(isset($key->photo))
                            <div class="p-0 m-0"><img src="/image/{{ $key->photo }}" width="600px" class="img-fluid"> </div> <br>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Side widgets-->
                <div class="col-lg-4">
                <div class="card mb-4">
                        <div class="card-header">Так же может быть интересно</div>
                        <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                    @foreach($chracterRandNames as $key)
                                      <li><a href="#!">{{$key->name}}</a></li>
                                    @endforeach
                                    </ul> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection