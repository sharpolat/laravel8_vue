@extends('layouts.app')

@section('content')
    <body>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Lore</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    @foreach($lores as $lore)
                    <div class="post-preview">
                        <a href="post.html">
                            
                            <h2 class="post-title"><a href="{{ route('loreContent.show', $lore->id) }}">{{ $lore->title }}</a></h2>
                            
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="{{route('profile.show', $lore->user->id)}}">{{$lore->user->name}}</a>
                        </p>
                    </div>
                    @if(Auth::user()->is_admin == 1)
                        <form method="POST" action="{{ route('lore.destroy', $lore->id) }}">
                            @method('delete')
                            @csrf
                            <div>                    
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                удалить
                            </button>                 
                            </div>
                        </form>
                    @endif
                    <!-- Divider-->
                    <hr class="my-4" />
                    @endforeach
                    
                    @auth
                        @if(Auth::user()->is_admin == 1)
                            <!-- Pager-->
                            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="{{route('lore.create')}}">Создать →</a></div>
                        @endif
                    @endauth

                    
                    
                </div>
            </div>
        </div>
        
        
    </body>

    @endsection

