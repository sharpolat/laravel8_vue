@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <div class="row">
        <div class="col-lg-8">
            @foreach($images as $image)
            <!-- Post content-->
            <div class="card pt-4 mb-2">
                <h3 class="fw-bolder mb-1 text-dark">https://www.papstudio.ru/image/{{$image->image}}</h3>
                <article>
                    <div class="p-0 m-0"><a href="/image/{{ $image->image }}"><img src="/image/{{ $image->image }}" width="800px" class="img-fluid"></a></div> <br>
                </article>
            </div>
            @endforeach
            {{ $images->links() }}
        </div>
        <div class="col-lg-4">
            <a href="{{ route('imagePage.create') }}">
                <button type="button" class="btn btn-outline-primary">Добавить</button>
            </a>    
        </div>
    </div>
</div>
@endsection