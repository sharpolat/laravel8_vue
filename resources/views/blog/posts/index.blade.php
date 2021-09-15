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
                            <div class="px-4 mb-4">
                                {!! $post->PostContent[$i]['body'] !!}
                            </div>
                            @elseif(isset($post->PostContent[$i]['photo']))
                                <div class="p-0 m-0"><a href="/image/{{ $post->PostContent[$i]['photo'] }}"><img src="/image/{{ $post->PostContent[$i]['photo'] }}" width="800px" class="img-fluid"></a></div> <br> 
                            @else
                            @continue
                            @endif
                        @endfor
                        
                    </article>
                    <div class="pb-3 pt-2 px-4 bg-light border border-light   ">
                        <a href="{{ route('post.show', $post->id) }}">
                            <button type="button" class="btn btn-primary btn-sm">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-square-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                            </svg>
                            </button>
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
                    <!-- Side widget-->
                    <!-- <div id="contenedor">
                        <iframe src="https://store.steampowered.com/widget/220/36/" frameborder="0" width="646" height="190"></iframe>
                    </div> -->
                    
                </div>
            </div>
        </div>

        <style 
        type="text/css">
                        #contenedor {
                        position: relative;
                        padding-bottom: 56.25%;
                        padding-top: 30px;
                        height: 0;
                        overflow: hidden;
                        display:block;
                        }
                        #contenedor iframe,
                        #contenedor object,
                        #contenedor embed {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        }
                        
        </style>
        
@endsection