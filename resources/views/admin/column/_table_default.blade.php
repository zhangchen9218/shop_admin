@if(isset($columns->keyword))
    @foreach ($columns as $column)
        <tr class="text-c">
            <td><input type="checkbox" name="del" value="{{$column->id}}"></td>
            <td>{{$column->id}}</td>
            <td>@foreach(COLUMN_CATEGORY as $v)@if($v['id']==$column->cotegory_id){{$v['name']}}@endif @endforeach</td>
            <td class="text-l">{{$column->name}}</td>
            <td>{{$column->level}}</td>
            <td>
                @if(Assist::checkRoutePower("admin/column/edit_state","post"))
                    @if ($column->state == COLUMN_STATE_START)
                        <button onclick="system_column_update( {{$column->id}},{{COLUMN_STATE_STOP}})" class="btn btn-success radius 	size-MINI">已开启</button>
                    @else
                        <button class="btn btn-default radius size-MINI" onclick="system_column_update( {{$column->id}},{{COLUMN_STATE_START}})">已关闭</button>
                    @endif
                @else
                    @if ($column ->state == COLUMN_STATE_START)
                        <span class="label label-success radius">已开启</span>
                    @else
                        <span class="label label-defaunt radius">已关闭</span>
                    @endif
                @endif
            </td>
            <td class="f-14">
                @if(Assist::checkRoutePower("admin/column/{column}/edit"))
                <a title="编辑" href="javascript:;" onclick="system_column_edit('栏目编辑','{{url("admin/column/$column->id/edit")}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                @endif

                @if(Assist::checkRoutePower("admin/column/{column}","delete"))
                <a title="删除" href="javascript:;" onclick="system_column_del({{$column->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                @endif
            </td>
        </tr>
    @endforeach
@else
    @foreach ($columns as $column)
        <tr class="text-c">
            <td><input type="checkbox" name="del" value="{{$column->id}}"></td>
            <td>{{$column->id}}</td>
            <td>@foreach(COLUMN_CATEGORY as $v)@if($v['id']==$column->cotegory_id){{$v['name']}}@endif @endforeach</td>
            <td class="text-l">@if ($column->pid){{new \Illuminate\Support\HtmlString(str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;",$column->level-1))}}├ @endif{{$column->name}}</td>
            <td>{{$column->level}}</td>
            <td>
                @if(Assist::checkRoutePower("admin/column/edit_state","post"))
                    @if ($column->state == COLUMN_STATE_START)
                        <button onclick="system_column_update( {{$column->id}},{{COLUMN_STATE_STOP}})" class="btn btn-success radius 	size-MINI">已开启</button>
                    @else
                        <button class="btn btn-default radius size-MINI" onclick="system_column_update( {{$column->id}},{{COLUMN_STATE_START}})">已关闭</button>
                    @endif
                @else
                    @if ($column->state == COLUMN_STATE_START)
                        <span class="label label-success radius">已开启</span>
                    @else
                        <span class="label label-defaunt radius">已关闭</span>
                    @endif
                @endif
            </td>
            <td class="f-14">
                @if(Assist::checkRoutePower("admin/column/{column}/edit"))
                <a title="编辑" href="javascript:;" onclick="system_column_edit('栏目编辑','{{url("admin/column/$column->id/edit")}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                @endif

                @if(Assist::checkRoutePower("admin/column/{column}","delete"))
                <a title="删除" href="javascript:;" onclick="system_column_del({{$column->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                @endif
            </td>
        </tr>
        {{\App\Packages\ColumnPackage\Facade\Column::columnTableList($column->subset)}}
    @endforeach
@endif