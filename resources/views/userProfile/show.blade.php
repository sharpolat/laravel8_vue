@extends('layouts.app')
@section('content')
<div class="row py-5 px-4">
    <div class="col-md-5 mx-auto">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3">
                    <img src="/image/{{ $user->profile_photo_path }}" class="rounded mb-2 img-thumbnail" alt="..." width="130">
                        <a href="{{route('profile.edit', $user->id)}}" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0">{{$user->name}}</h4>
                        <p class="small mb-4">Дата регистрации: {{$user->created_at}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <!-- <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">215</h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>комментариев</small>
                    </li>
                </ul> -->
            </div>
            <div class="px-4 pt-4">
                <h5 class="mb-0">About me</h5>
                <div class="p-4 rounded shadow-sm bg-light">
                        @if($user->about_me == null)
                        <h4 class="mt-0 mb-0">расскажите о себе</h4>
                        @else
                        <h4 class="mt-0 mb-0">{{$user->about_me}}</h4>
                        @endif
                </div>
            </div>
            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Recent comments</h5>
                </div>
                    @foreach($comments as $comment)
                    <p class="mb-0 text-break">{{$comment->body}} на пост <a href="{{route('post.show', $comment->post_id)}}">({{$comment->post->title}})</a></p><br>
                    @endforeach
                    {{$comments->links()}}
            </div>

        </div>
    </div>
</div>
@endsection