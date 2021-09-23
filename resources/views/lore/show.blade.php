@extends('layouts.app')

@section('content')

<div class="container">
<div class="accordion" id="accordionExample">
    @foreach($loreContents as $content)
  <div class="item">
     <div class="item-header" id="headingOne">
        <h2 class="mb-0">
           <button class="btn btn-link" type="button" data-toggle="collapse"
              data-target="#collapseOne{{$content->id}}" aria-expanded="true" aria-controls="collapseOne{{$content->id}}">
           {{ $content->title }}
           
           </button>
        </h2>
     </div>
     <div id="collapseOne{{$content->id}}" class="collapse show" aria-labelledby="headingOne"
        data-parent="#accordionExample" aria-multiselectable="true">
        <div class="t-p">
            {!!$content->body!!}
        </div>
     </div>
  </div>
  @auth
  @if(Auth::user()->is_admin == 1)
    <form method="POST" action="{{ route('loreContent.destroy', $content->id) }}">
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
  @endForeach
  
</div>
    @auth
        @if(Auth::user()->is_admin == 1)            
        <form method="POST" action="{{ route('loreContent.store') }}">
            
            @csrf
            <h6>Создать( Это видишь только ты )</h6>
            <p> <input placeholder="Заголовок" name="title"></p>
            <textarea name="body" placeholder="Содержимое" type="textarea" class="ck_editor_txt" id="ckeditor"></textarea>
            <input name="lore_id" type="hidden" value='{{ $id }}'>
            <button class="btn btn-outline-primary mt-2" type="submit">Добавить</button>
        </form>
        @endif
    @endauth
</div>
@if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ $errors->first() }}
                </div>
            </div>
        </div>
        @endif
@endsection
@section('scripts')
<script>
    var allEditors = document.querySelectorAll('.ck_editor_txt');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>
@endsection