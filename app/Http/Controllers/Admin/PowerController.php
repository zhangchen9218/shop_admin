<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBackgroundLog;
use App\Http\Requests\PowerRequest;
use App\Power;
use http\Env\Response;
use Illuminate\Http\Request;

class PowerController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->input("keyword","");
        if($keyword){
            $powerRes = Power::where("name","like","%".$keyword."%")->paginate(20);
        }else{
            $powerRes = Power::paginate(20);
        }
        return view("admin.admin_permission",["powerRes"=>$powerRes,"keyword"=>$keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acmeRes = Power::where("acme",1)->get();
        return view("admin.admin_permission_add",['acmeRes'=>$acmeRes]);
    }

    /**
     * @param PowerRequest $request
     * @param Power $power
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (PowerRequest $request, Power $power)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["添加节点成功"],
        ];

        $power['name'] = $request->input("name");
        $power['belong_to'] = $request->input("belong_to",0);
        $power['field'] = $request->input("field","");
        $power['acme'] = $request->input("acme",0);
        $bool = $power->save();

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["添加节点失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "增加权限节点")));

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Power $power
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Power $power)
    {
        $acmeRes = Power::where("acme",1)->get();
        return view("admin.admin_permission_update",['power'=>$power,"acmeRes"=>$acmeRes]);
    }

    /**
     * @param PowerRequest $request
     * @param Power $power
     */
    public function update(PowerRequest $request, Power $power)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改节点成功"],
        ];
        $power['name'] = $request->input("name");
        $power['belong_to'] = $request->input("belong_to",0);
        $power['field'] = $request->input("field","");
        $power['acme'] = $request->input("acme",0);

        $bool = $power->save();
        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改节点失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改权限节点")));

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);

        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["删除成功"],
        ];

        $ids = $request->input("id");

        $bool = Power::destroy($ids);

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除权限节点")));

        return response()->json($data);
    }
}
