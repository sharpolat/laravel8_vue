@foreach($idArr as $id)
    {{$id}}
    <a href="{{ route('parserForKrisha.show', $id) }}">Показать</a> <br>
@endforeach