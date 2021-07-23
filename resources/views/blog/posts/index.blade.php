@extends('layouts.app')

@section('content')
<!-- Page content-->
<div class="container-sm mt-5">
            <div class="row" >
                
                <div class="col-lg-8">
                    @if(Route::is('tag.show'))
                        <h2 class="fw-bolder mb-1 text-dark mb-4">Все статьи где присутсвтует тег - {{ $tagName }}</h2>
                    @endif
                    @foreach($posts as $post)
                    <!-- Post content-->
                    <div class="card pt-4 mb-2">
                    <article>
                        <!-- Post header-->
                        <header class=" px-4 mb-4">
                            <!-- Post title-->
                            <a href="{{ route('post.show', $post->id) }}">
                                <h1 class="fw-bolder mb-1 text-dark">{{$post->title}}</h1>
                            </a>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on {{ $post->created_at }}</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="{{route('tag.show', $post->tags) }}">{{ $post->tags }}</a>
                        </header>
                        
                        
                        @for($i = 0; $i < count($post->PostContent); $i++)
                            @if(isset($post->PostContent[$i]['body']))
                                <p class="fs-5 px-4 mb-1">{{ $post->PostContent[$i]['body'] }} </p> <br>
                            @elseif(isset($post->PostContent[$i]['photo']))
                                <div class="p-0 m-0"><img src="/image/{{ $post->PostContent[$i]['photo'] }}" width="800px" class="img-fluid"> </div> <br>
                            @else
                            @continue
                            @endif
                        @endfor
                       
                    </article>
                    
                    <div class="mb-4 px-4">
                        <a href="{{ route('post.show', $post->id) }}">
                            <button  href="" type="button" class="btn btn-primary btn-sm">{{$post->id}}</button>
                        </a>
                        @auth
                            @if(Auth::user()->is_admin == 1)
                                <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                                @method('delete')
                                @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Удалить этот пост
                                    </button>
                                </form>
                                @endif
                        @endauth
                    </div>
                    </div>
                    
                    @endforeach
                    {{ $posts->links() }}
                </div>
                
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                        <li><a href="#!">Freebies</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>
@endsection