@foreach($idArr as $id)
    {{$id}}
    <a href="{{ route('parser.show', $id) }}">Показать</a> <br>
@endforeach