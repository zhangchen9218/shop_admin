<?php
namespace App\Packages\ColumnPackage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;

/**
 * Created by PhpStorm.
 * User: Other
 * Date: 2019/9/2
 * Time: 18:24
 */
class Column{
    function __construct()
    {
    }

    function columnSelectList($columns, $selectId=0, $filter_id = 0 ,$view="admin.column._select_default" ){
        if(!$columns || collect($columns)->isEmpty()){
            return false;
        }

        return new HtmlString(View::make($view, ["columns"=>$columns, "selectId"=>$selectId, "view"=>$view ,"filter_id" => $filter_id])->render());
    }


    function columnTableList($columns ,$view="admin.column._table_default"){
        if(!$columns || collect($columns)->isEmpty()){
            return false;
        }

        return new HtmlString(View::make($view, ["columns"=>$columns])->render());
    }
}