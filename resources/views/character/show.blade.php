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
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                            <rect width="100%" height="100%" fill="#868e96"></rect>
                            <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">{{ $characterData->body }}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                        @for($i = 0; $i < count($characterData->characterShow); $i++)
                          <li class="list-group-item">{{ $characterData->characterShow[$i]['title'] }}</li>
                        @endfor
                        </ul>
                        
                    </div>
                    @foreach($characterData->characterShow as $key)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$key->title}}</h5>
                            <p class="card-text">{{$key->body}}</p>
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