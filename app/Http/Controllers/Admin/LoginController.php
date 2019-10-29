<?php

namespace App\Http\Controllers\Admin;
use App\Events\AdminBackgroundLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginCheckRequest;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view("/admin.login");
    }

    public function doLogin(LoginCheckRequest $request)
    {
        event(new AdminBackgroundLog(array("route" => $request->route()->uri,"param"=> "", "describe" => "登录成功")));
        return  redirect("/admin");
    }

    public function loginOut(){
        session()->flush();
        return redirect("/admin");;
    }
}
