@extends('layouts.app')

@section('content')

        <!-- Page content-->
        <div class="container-sm mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">{{ $postId->title }}</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on {{ $postId->created_at }}</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $postId->tags }}</a>
                        </header>
                        <!-- Preview image figure-->
                        
                        <!-- Post content-->
                        <section class="mb-5">
                        @for($i = 0; $i < count($postId->PostContent); $i++)
                            @if(isset($postId->PostContent[$i]['body']))
                                <p class="fs-5 mb-1">{{ $postId->PostContent[$i]['body'] }} </p> <br>
                            @elseif(isset($postId->PostContent[$i]['photo']))
                                <div class="p-0 m-0"><img src="/image/{{ $postId->PostContent[$i]['photo'] }}" width="680px" class="img-fluid"> </div> <br>
                            @else
                            @continue
                            @endif
                        @endfor
                        </section>
                    </article>
                    <hr class="bg-dark">
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <input placeholder="комментарий" type="text" name="body" value="">
                                <input type="hidden" name="post_id" value="{{ $postId->id }}">
                                @auth
                                <input type="hidden" name="user_display_name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                @endauth
                                @guest
                                <input type="hidden" name="user_id" value="1">
                                <input type="hidden" name="user_display_name" value="guest">
                                @endguest

                                <button type="submit">отправить</button>

                                <button type="reset">очистить</button>
                            </form>
                            @if( $errors->any() )
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            @foreach($comments as $comment)
                                <!-- Comment with nested comments-->
                                <div class="d-flex mt-4">
                                    <!-- Parent comment-->
                                    <div class="ms-3">
                                        <div class="fw-bold">{{ $comment->user_display_name  }}</div>
                                        {{ $comment->body }}
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-sm-row">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            ответить
                                        </button>
                                    @auth
                                        @if(Auth::user()->id == $comment->user->id)
                                            <form method="POST" action="{{ route('comment.destroy', $comment->id) }}">
                                            @method('delete')
                                            @csrf
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    удалить
                                                </button>
                                            </div>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                                <hr>
                            @endforeach
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">News</a></li>
                                        <li><a href="#!">Characters</a></li>
                                        <li><a href="#!">Lore</a></li>
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
