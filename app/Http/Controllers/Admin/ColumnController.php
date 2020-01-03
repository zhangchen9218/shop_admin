<?php

namespace App\Http\Controllers\Admin;

use App\Model\ColTemplate;
use App\Model\Column;
use App\Events\AdminBackgroundLog;
use App\Http\Requests\ColumnRequest;
use App\Packages\ColumnPackage\Facade\Column as FColumn;
use App\Model\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ColumnController extends BaseController
{

    /**
     * @param Request $request
     * @param Column $column
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Column $column)
    {
        $keyword = $request->input("keyword","");
        if($keyword){
            $columnRes = $column -> getColumnTreeByDate($keyword);
            $columnRes->keyword = $keyword;
        }else{
            $columnRes = $column -> getColumnTree();
        }

        $list = FColumn::columnTableList($columnRes);
        return view("admin.system_column_list" ,["list"=>$list,"keyword"=>$keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Column $column)
    {
        $columnRes = $column -> getColumnTree();
        $html = FColumn::columnSelectList($columnRes,0,0,"admin.column._select_choosable");
        return view("admin.system_column_add",["html"=>$html]);
    }

    /**
     * @param ColumnRequest $request
     * @param Column $column
     * @param ColTemplate $colTemplate
     * @param Seo $seo
     */
    public function store(ColumnRequest $request,Column $column, Seo $seo)
    {
        $column['pid'] = $request->input("pid", 0);
        $column['level'] = $request->input("level", 0);
        $column['name'] = $request->input("name");
        $column['cotegory_id'] = $request->input("cotegory_id");
        $column['selectable'] = $request->input("selectable", 0);
        $bool = $column->save();

        if($bool){

            $seo['keyword'] = $request->input("keyword");
            $seo['describe'] = $request->input("describe");
            if($seo["keyword"] || $seo['describe']){
                $seo['column_id'] = $column->id;
                $seo->save();
            }


            $colTemplate['column_id'] = $column->id;
            $colTemplate['limit'] = intval($request->input("limit"));

            if(!empty($request->file('index_page'))){
                $path = Storage::putFileAS('index', $request->file('index_page'),$request->file('index_page')->hashName().".blade.php","private");
                $colTemplate['templ_uri'] = Storage::url($path);
                $colTemplate['templ_type'] = COL_TEMPLATES_INDEX;
                ColTemplate::create($colTemplate);
            }
            if(!empty($request->file('list_page'))){
                $path = Storage::putFileAS('list', $request->file('list_page'),$request->file('list_page')->hashName().".blade.php","private");
                $colTemplate['templ_uri'] = Storage::url($path);
                $colTemplate['templ_type'] = COL_TEMPLATES_LIST;
                ColTemplate::create($colTemplate);
            }
            if(!empty($request->file('show_page'))){
                $path = Storage::putFileAS('show', $request->file('show_page'),$request->file('show_page')->hashName().".blade.php","private");
                $colTemplate['templ_uri'] = Storage::url($path);
                $colTemplate['templ_type'] = COL_TEMPLATES_SHOW;
                ColTemplate::create($colTemplate);
            }
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加栏目")));

        return "<script>top.location.href='".url("admin/column")."'</script>";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Column  $column
     */
    public function show(Column $column)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function edit(Column $column)
    {
        $columnRes = $column -> getColumnTree();
        $html = FColumn::columnSelectList($columnRes,$column->pid,$column->id,"admin.column._select_choosable");
        return view("admin.system_column_update",["html"=>$html,"column"=>$column]);
    }

    /**
     * @param ColumnRequest $request
     * @param Column $column
     * @return string
     */
    public function update(ColumnRequest $request, Column $column)
    {
        $column['pid'] = $request->input("pid");
        $column['level'] = $request->input("level");
        $column['name'] = $request->input("name");
        $column['cotegory_id'] = $request->input("cotegory_id");
        $column['selectable'] = $request->input("selectable", 0);
        $column->save();

        if(!$column->seo){
            $column->seo = new Seo();
            $column->seo['column_id'] = $column->id;
        }
        $column->seo['keyword'] = !$request->input("keyword") ? : $request->input("keyword");
        $column->seo['describe'] = !$request->input("describe") ? : $request->input("describe");
        $column->seo->save();

        $limit = intval($request->input("limit"));
        ColTemplate::where("column_id",$column->id)->update(["limit"=>$limit]);

        if(!empty($request->file('index_page'))){
            $path = Storage::putFileAS('index', $request->file('index_page'),$request->file('index_page')->hashName().".blade.php","private");
            ColTemplate::where([
                ["column_id",$column->id],
                ["templ_type",COL_TEMPLATES_INDEX]
            ])->update(['templ_uri'=>Storage::url($path)]);
        }

        if(!empty($request->file('list_page'))){
            $path = Storage::putFileAS('list', $request->file('list_page'),$request->file('list_page')->hashName().".blade.php","private");
            ColTemplate::where([
                ["column_id",$column->id],
                ["templ_type",COL_TEMPLATES_LIST]
            ])->update(['templ_uri'=>Storage::url($path)]);
        }

        if(!empty($request->file('show_page'))){
            $path = Storage::putFileAS('show', $request->file('show_page'),$request->file('show_page')->hashName().".blade.php","private");
            ColTemplate::where([
                ["column_id",$column->id],
                ["templ_type",COL_TEMPLATES_LIST]
            ])->update(['templ_uri'=>Storage::url($path)]);
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改栏目")));

        return "<script>top.location.href='".url("admin/column")."'</script>";
    }

    /**
     * @param Request $request
     * @param Column $column
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);

        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["删除资讯成功"],
        ];

        $cids = $request->input("id");
        $column = new Column();

        if(is_array($cids)){
            $tempArr = $cids;
            foreach($tempArr as $id) {
                $cids = Arr::collapse([$column->getColumnSubsetId($id), $cids]);
            }
        }else{
            $temp = $cids;
            $cids = $column->getColumnSubsetId($cids);
            $cids[] = $temp;
        }

        $bool = Column::destroy($cids);

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除栏目")));

        return response()->json($data);
    }

    public function editState(Request $request){
        $request->validate([
            "id" => "required|integer",
            "state" => "required|integer",
        ]);
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改状态成功"],
        ];

        $id = $request->input("id");
        $state = $request->input("state");

        $column = new Column();

        $cids = $column->getColumnSubsetId($id);
        $cids[] = $id;

        Column::whereIn("id",$cids)->update(['state' => $state]);

        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改栏目状态")));

        return response()->json($data);
    }
}
