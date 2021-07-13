@extends('layouts.app')

@section('content')
  @if(isset($searchCharacters))
    <main role="main" class="container">

    <div class="my-3 p-3 bg-white rounded box-shadow">

      <h6 class="border-bottom border-gray pb-2 mb-0">Результат поиска</h6>

      <div class="media text-muted pt-3">
      
      <form method="GET" action="{{ route('search') }}">
      @csrf
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
          aria-describedby="search-addon" name="body" />
        <button type="submit" class="btn btn-outline-primary">search</button>
      </form>
      </div>
      @foreach($searchCharacters as $character)
      <div class="media text-muted pt-3">
        <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{ $character->photo }}">
        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
          <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
          {{ $character->body }}
        </p>
      </div>
      @endforeach
      {{ $searchCharacters->links() }}
      
    </div>

    </main>
  @else

  <main role="main" class="container">

        <div class="my-3 p-3 bg-white rounded box-shadow">
        
          <h6 class="border-bottom border-gray pb-2 mb-0">Главные персонажи</h6>

          

          <div class="media text-muted pt-3">
          
          <form method="GET" action="{{ route('search') }}">
          @csrf
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
              aria-describedby="search-addon" name="body" />
            <button type="submit" class="btn btn-outline-primary">search</button>
          </form>
          </div>


          @foreach($mainCharacters as $character)
          <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{ $character->photo }}" data-holder-rendered="true">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
              {{ $character->body }}
            </p>
          </div>
          @endforeach
          {{ $mainCharacters->links() }}
          
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
          <h6 class="border-bottom border-gray pb-2 mb-0">NPC</h6>
          
          @foreach($npcCharacters as $character)
          <div class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{ $character->photo }}" data-holder-rendered="true">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <strong class="d-block text-gray-dark"><a href="{{ route('character.show', $character->id) }}">{{ $character->name }}</a></strong>
              {{ $character->body }}
            </p>
          </div>
          @endforeach
          {{ $npcCharacters->links() }}
        </div>
      </main>
      @endif
    @endsection 