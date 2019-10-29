
@foreach ($columns as $column)
    @if ($column->selectable)
        <option value="{{$column->id}}" level="{{$column->level}}" @if(collect($selectId)->isNotEmpty() && $selectId == $column->id) selected @endif>
            @if ($column->level > 1)
                {{new \Illuminate\Support\HtmlString(str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$column->level-1))}}├
            @endif
            {{$column->name}}
        </option>
        {{\App\Packages\ColumnPackage\Facade\Column::columnSelectList($column->subset,$selectId,$filter_id,$view)}}
    @else
        <optgroup label="@if ($column->level > 1)&nbsp;&nbsp;&nbsp;{{new \Illuminate\Support\HtmlString(str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$column->level-1))}}├@endif {{$column->name}}">
            {{\App\Packages\ColumnPackage\Facade\Column::columnSelectList($column->subset,$selectId,$filter_id,$view)}}
        </optgroup>
    @endif
@endforeach