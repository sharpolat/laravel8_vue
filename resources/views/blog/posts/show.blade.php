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
                            
                        </header>
                        <!-- Preview image figure-->
                        
                        <!-- Post content-->
                        <section class="mb-5">
                        @for($i = 0; $i < count($postId->PostContent); $i++)
                            @if(isset($postId->PostContent[$i]['body']))
                                {!! $postId->PostContent[$i]['body'] !!}
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
                                <form method="POST" action="{{ route('comment.store') }}" class="pb-3">
                                    @csrf
                                    
                                    <textarea placeholder="комментарий" class="form-control" type="text" name="body"></textarea>
                                    <input type="hidden" name="post_id" value="{{ $postId->id }}">
                                    @guest
                                    <input type="hidden" name="guest" value="guest">
                                    @endguest

                                    <button type="submit" class="btn btn-outline-primary btn-sm">отправить</button>

                                    <button type="reset" class="btn btn-outline-primary btn-sm">очистить</button>
                                </form>
                                @if( $errors->any() )
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                                @endif

                                @foreach($comments as $comment)
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $comment->user_display_name  }}</h5>
                                        <p class="mb-0 text-break">{{ $comment->body }}</p>
                                        
                                            <div class="btn-group">
                                                <a class=" dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ответить
                                                </a>
                                                <div class="dropdown-menu">
                                                    <div class="d-flex flex-sm-row">

                                                        <form method="POST" action="{{ route('nestedComment.store') }}">
                                                        @csrf
                                                        <textarea placeholder="комментарий" type="text" name="body"></textarea>
                                                        <input type="hidden" name="post_id" value="{{ $postId->id }}">
                                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                        @guest
                                                        <input type="hidden" name="guest" value="guest">
                                                        @endguest
                                                        

                                                        <button type="submit">отправить</button>

                                                        <button type="reset">очистить</button>
                                                        </form>

                                                    <div>
                                                </div>
                                                </div>
                                            </div>
                                        @auth
                                            @if(Auth::user()->is_admin == 1)
                                                <form method="POST" action="{{ route('comment.destroy', $comment->id) }}">
                                                @method('delete')
                                                @csrf
                                                <div>
                                                    <a href="">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                                        удалить
                                                    </button>
                                                    </a>
                                                </div>
                                                </form>
                                            @endif
                                        @endauth
                                        </div>
                                        
                                        @foreach($comment->nestedComment as $key)
                                            @if(isset($key->body))
                                            <!-- Nested comment -->
                                            <div class="verticalLine">
                                            <div class="media mt-2">
                                                <a class="d-flex pr-3" href="#">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{ $key->user_display_name }}</h5>
                                                    <p class="text-break"> {{ $key->body }} </p>
                                                </div>
                                            </div>
                                            </div>
                                            @auth
                                            
                                            @if(Auth::user()->is_admin == 1)
                                                <form method="POST" action="{{ route('nestedComment.destroy', $key->id) }}">
                                                @method('delete')
                                                @csrf
                                                <div>
                                                    
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                                    удалить
                                                    </button>
                                                    
                                                </div>
                                                </form>
                                            @endif
                                        @endauth
                                            @endif
                                        @endforeach
                                        
                                    </div>
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
