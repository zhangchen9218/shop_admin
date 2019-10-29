@foreach ($columns as $column)
    @if ($column->id == $filter_id)
        @continue
    @endif
    <option value="{{$column->id}}" level="{{$column->level}}" @if(collect($selectId)->isNotEmpty() && $selectId == $column->id) selected @endif>
        @if ($column->level > 1)
            {{new \Illuminate\Support\HtmlString(str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$column->level-1))}}├
        @endif
        {{$column->name}}
    </option>
    {{\App\Packages\ColumnPackage\Facade\Column::columnSelectList($column->subset,$selectId,$filter_id,$view)}}
@endforeach