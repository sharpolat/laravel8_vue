@extends('layouts.app')
@section('content')
@if(Auth::user()->is_admin == 1)
<div class="container">
    <div class="row ">

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>email</th>
                    <th>message</th>
                    <th>file_name</th>
                    <th>удалить</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <th scope="row">{{$file->created_at}}</th>
                    <td>{{$file->name}}</td>
                    <td>{{$file->email}}</td>
                    <td>{{$file->message}}</td>
                    <td> <a href="/uploads/{{$file->file_path}}">{{$file->file_path}}</a></td>
                    <td>@auth
                        @if(Auth::user()->is_admin == 1)
                        <form method="POST" action="{{ route('projectHelp.destroy', $file->id) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                Удалить
                            </button>
                        </form>
                        @endif
                        @endauth
                        @endforeach
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endif

@endsection