<?php

use App\Model\ChinaArea;

function provinces(){
    return ChinaArea::where('parent_id','1')->get();
}

function cityAreas($id){
    return ChinaArea::where('parent_id', $id)->get();
}

