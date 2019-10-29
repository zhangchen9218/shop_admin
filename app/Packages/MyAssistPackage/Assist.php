<?php
namespace App\Packages\MyAssistPackage;

use Illuminate\Support\Facades\Route;

/**
 * Created by PhpStorm.
 * User: Other
 * Date: 2019/9/2
 * Time: 18:24
 */
class Assist{
    function __construct()
    {
    }

    /**
     * 通过uri获取路由名称
     * @param string $uri
     * @param string $method
     * @param bool $acme
     * @return bool
     */
    function checkRoutePower($uri="admin/article/edit_state", $method = "get", $acme = false){
        $routeName = $uri;
        $powers = session()->get("role_powers");

        if(!$acme){
            $routeName = Route::getRoutes()->match(request()->create(url($uri),$method))->getName();
        }

        if($routeName && in_array($routeName , $powers)){
            return true;
        }
        return false;
    }

}