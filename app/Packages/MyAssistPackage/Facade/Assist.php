<?php
/**
 * Created by PhpStorm.
 * User: Other
 * Date: 2019/9/3
 * Time: 9:57
 */
namespace App\Packages\MyAssistPackage\Facade;


use Illuminate\Support\Facades\Facade;


class Assist extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'assist';
    }
}