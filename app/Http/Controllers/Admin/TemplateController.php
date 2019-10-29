<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBackgroundLog;
use App\Http\Requests\TemplateRequest;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TemplateController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->input("keyword","");
        if($keyword){
            $templates = Template::where("name","like","%".$keyword."%")->simplePaginate(10);
        }else{
            $templates = Template::simplePaginate(10);
        }
        return view("admin.template_list",["templates"=>$templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.template_add");
    }

    /**
     * @param TemplateRequest $request
     * @param Template $template
     * @return string
     */
    public function store(TemplateRequest $request,Template $template)
    {
        $template["type"]          = $request->input("type");
        $template["name"]          = $request->input("name");
        $template["keyword"]         = $request->input("keyword");
        $template["icon"]            = $request->input("icon","");
        $template["describe"]       = $request->input("describe","");

        $template["templ_uri"]  = Storage::putFileAS('page', $request->file('template'),$request->file('template')->hashName().".blade.php","private");
        $template->save();
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加模板")));

        return "<script>top.location.href='".url("admin/template")."'</script>";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        $uri = "template/".Str::before($template->templ_uri,".blade.php");

        return view($uri);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view("admin.template_update",["template"=>$template]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'integer',
        ],[
            "name.required" => "模板名称必须填写"
        ]);

        $template['type'] = $request->input("type");
        $template['name'] = $request->input("name");
        $template['icon'] = $request->input("icon");
        $template['keyword'] = $request->input("keyword","");
        $template['describe'] = $request->input("describe","");
        $template->save();
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改模板")));

        return "<script>top.location.href='".url("admin/template")."'</script>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template $template
     * @return \Illuminate\Http\Response
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

        $ids = $request->input("id");

        $bool = Template::destroy($ids);

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除资讯失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除模板")));

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request){
        $request->validate([
            "file" => "image"
        ],[
            "file.image" => "上传类型必须是（jpeg, png, bmp, gif）"
        ]);

        $path = Storage::putFile('public/template_icon', $request->file('file'), "public");
        $path = Storage::url($path);
        return response()->json(["data"=>$path]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        $template = Template::find($id);
        $template['state'] = $request->input("state");
        $template->save();
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改模板状态")));

        return response()->json($data);
    }

    public function getTemplateByType($typeId){
        $templateRes = Template::where("type" , $typeId)->get();
        return view("admin.template_by_type_list",["templateRes"=>$templateRes]);
    }
}
