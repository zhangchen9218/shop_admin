<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Events\AdminBackgroundLog;
use App\Http\Requests\AdminRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyWord = $request->input("key_word","");
        if($keyWord){
            $adminRes = Admin::where("real_name","like","%{$keyWord}%")->paginate(20);
        }else{
            $adminRes = Admin::paginate(20);
        }
        return view("admin.admin_list",['adminRes'=>$adminRes]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Role $role)
    {
        $roleRes = $role->all();
        return view("admin.admin_add",["roleRse"=>$roleRes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request,Admin $admin)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["添加管理员成功"],
        ];
        $admin->real_name = $request->input("real_name");
        $admin->password = Hash::make($request->input("password"));
        $admin->account = $request->input("account");
        $admin->role = $request->input("role");
        $admin->tel = $request->input("tel");
        $admin->state = Admin::ADMIN_STATE_ON;
        $row = $admin->save();
        if(!$row){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["添加管理员失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "添加管理员")));
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        dd($admin);
    }

    /**
     * @param Role $role
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role, $id)
    {
        $admin = Admin::find($id);
        $roleRes = $role->all();
        return view("admin.admin_update",["roleRse"=>$roleRes,'admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["修改管理员成功"],
        ];
        $admin = Admin::find($id);
        $admin->id = $request->input("id");
        $admin->real_name = $request->input("real_name");
        $admin->account = $request->input("account");
        $admin->role = $request->input("role");
        $admin->tel = $request->input("tel");
        $password = $request->input("password","");
        if($password) $admin->password = Hash::make($password);
        $row = $admin->save();
        if(!$row){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改管理员失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改管理员")));
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);

        $data = [
            "code" => CODE_SUCCESS,
            "msg" => ["删除管理员成功"],
        ];

        $id = $request->input("id");
        $bool = Admin::destroy($id);
        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["删除管理员失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "删除管理员")));
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

        $admin = Admin::find($id);
        $admin->state = $request->input("state");

        $bool = $admin->save();
        if(!$bool){
            $data = [
                "code" => CODE_FAIL,
                "msg" => ["修改状态失败"],
            ];
        }
        event(new AdminBackgroundLog(array("route" => $request->route()->uri, "param" => $request->toArray(), "describe" => "修改管理员状态")));
        return response()->json($data);
    }
}
