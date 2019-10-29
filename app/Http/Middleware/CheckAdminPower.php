<?php

namespace App\Http\Middleware;

use App\Exceptions\Handler;
use Closure;

class CheckAdminPower
{
    private $ignore = [
        "article.show",
        "template.show"
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        if(!$routeName){
            return $next($request);
        }
        if(in_array($routeName,$this->ignore)){
            return $next($request);
        }
        $powers = session()->get("role_powers");
        if(in_array($routeName,$powers)){
            return $next($request);
        }
       return abort(401,"未授权禁止访问");
    }
}
