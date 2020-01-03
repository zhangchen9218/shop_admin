<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBackgroundLog;
use App\Http\Requests\RoleRequest;
use App\Model\Power;
use App\Model\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleRes = Role::paginate(20);
        return view("admin.admin_role_list",["roleRes" => $roleRes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Power $power)
    {
        $list = $power->powerTree();
        return view("admin.admin_role_add", ['list'=> $list]);
    }

    /**
     * @param Request $request
     * @param Role $role
     */
    public function store(RoleRequest $request, Role $role)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["添加身份成功"],
        ];

        $role['name'] = $request->input("name");
        $role['describe']  = $request->input("describe","");
        $power_ids  = $request->input("power_ids","");
        $role['power_ids']  = implode(",", $power_ids);
        $bool = $role->save();

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["添加身份失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加身份")));

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
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( Role $role,Power $power)
    {
        $list = $power->powerTree();
        $powerIds = explode(",",$role->power_ids);
        return view("admin.admin_role_update", ['list'=> $list, 'role'=>$role ,'powerIds'=>$powerIds]);
    }

    /**
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改身份成功"],
        ];

        $role['name'] = $request->input("name");
        $role['describe']  = $request->input("describe","");
        $power_ids  = $request->input("power_ids","");
        $role['power_ids']  = implode(",", $power_ids);
        $bool = $role->save();

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改身份失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改身份")));

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

        $bool = Role::destroy($ids);

        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除身份")));

        return response()->json($data);
    }
}
