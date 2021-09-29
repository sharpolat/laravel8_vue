@extends('layouts.app')

@section('content')
@if(isset($searchCharacters))
<main role="main" class="container">

  <div class="my-3 p-3 bg-white rounded box-shadow">

    <h6 class="border-bottom border-gray pb-2 mb-0">Результаты поиска</h6>

    <div class="media text-muted pt-3">

      <form method="GET" action="{{ route('search') }}">
        @csrf
        <div class="d-flex justify-content-center h-100">
          <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" minlength="2" name="body" required>
          <button type="submit" class="btn btn-outline-primary">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
          </button>
        </div>
      </form>
    </div>
    @foreach($searchCharacters as $character)
    <div class="media text-muted pt-3">
      <img class="mr-2 rounded" style="width: 50px; height: 50px;" src="/image/{{ $character->photo }}">
      <p class="media-body pb-3 mb-0 border-bottom border-gray">
        <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
        {!! $character->body !!}
        @auth 
          @if(Auth::user()->is_admin == 1)
            <form method="POST" action=" {{ route('character.destroy', $character->id) }} ">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-primary btn-sm">удалить персонажа</button>
            </form>
          @endif
        @endauth
      </p>
    </div>
    @endforeach
    {{ $searchCharacters->links() }}

  </div>

</main>
@else

<main role="main" class="container">

  <div class="my-3 p-3 bg-white rounded box-shadow">

    



    <div class="media text-muted pt-3">

      <form method="GET" action="{{ route('search') }}">
        @csrf
        <div class="d-flex justify-content-center h-100">
          <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" minlength="2" name="body" required>
          <button type="submit" class="btn btn-outline-primary">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
          </button>
        </div>
      </form>
    </div>

    <h6 class="border-bottom border-gray pb-2 my-2">Главные персонажи</h6>
    @foreach($mainCharacters as $character)
    <div class="media text-muted pt-3">
      <img class="mr-2 rounded" style="width: 50px; height: 50px;" src="/image/{{ $character->photo }}" >
      
      <div>
        <p class="media-body pb-3 mb-0 ">
        <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
        {!! $character->body !!}</div>
        @auth 
          @if(Auth::user()->is_admin == 1)
            <form method="POST" action=" {{ route('character.destroy', $character->id) }} ">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-primary btn-sm">удалить персонажа</button>
            </form>
          @endif
        @endauth
      </p>
    </div>
    @endforeach
    {{ $mainCharacters->appends(['mainCharacters' => $npcCharacters->currentPage()])->links() }}

  </div>

  <div class="my-3 p-3 bg-white rounded box-shadow">
    <h6 class="border-bottom border-gray pb-2 mb-0">NPC</h6>

    @foreach($npcCharacters as $character)
    <div class="media text-muted pt-3 d-flex flex-row">
      <img alt="50x50" class="mr-2 rounded" style="width: 50px; height: 50px;" src="/image/{{ $character->photo }}" data-holder-rendered="true">
      
      <div><p class="media-body pb-3 mb-0">
        <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
        {!! $character->body !!}</div>
        @auth 
          @if(Auth::user()->is_admin == 1)
            <form method="POST" action=" {{ route('character.destroy', $character->id) }} ">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-primary btn-sm">удалить персонажа</button>
            </form>
          @endif
        @endauth
      </p>
    </div>
    @endforeach
    {{ $npcCharacters->appends(['npcCharacters' => $mainCharacters->currentPage()])->links() }}
  </div>
</main>
@endif
@endsection