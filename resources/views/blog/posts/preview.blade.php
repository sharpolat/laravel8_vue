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
                            <h1 class="fw-bolder mb-1">{{ $old['title'] }}</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on 1970-01-01 09:33:48</div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $old['tags'] }}</a>
                        </header>
                        <!-- Preview image figure-->
                        
                        <!-- Post content-->
                        <section class="mb-5">
                        @for($i = 0; $i < count($old->body); $i++)
                            @if(isset($old[$i]['body']))
                                {!! $old[$i]['body'] !!}
                            @elseif(isset($old[$i]['photo']))
                                <div class="p-0 m-0"><img src="/image/{{ $postId->PostContent[$i]['photo'] }}" width="680px" class="img-fluid"> </div> <br>
                            @else
                            @continue
                            @endif
                        @endfor
                        </section>
                    </article>
                    
                    
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
