<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Power extends Model
{

    /**
     * 获取权限树
     * @return mixed
     */
    public function powerTree(){
        $powerT = $this->getPowerByAcmeChangeArr(1);

        foreach ($powerT as $ak => &$acme){
            $acme["index"] = $this->powerTreeStepOne($acme);
        }
        return $powerT;
    }

    /**
     * 根据层级获取权限数组
     * @param int $acme
     * @return mixed
     */
    public function getPowerByAcmeChangeArr($acme = 0){
        $powerRes = Power::where("acme",$acme)->get()->toArray();
        return $powerRes;
    }

    /**
     * 获取权限树的第一层
     * @param $acme
     * @return array
     */
    private function powerTreeStepOne($acme){
        $res = $this->powerTreeStepTow($acme);
        foreach($res as $key=>&$val){
            $val['res'] = $this->powerTreeStepTow($val,"index");
        }
        return $res;
    }

    /**
     * 获取权限树的第二层
     * @param $power
     * @param string $layout
     * @return array
     */
    private function powerTreeStepTow($power,$layout = "base"){
        $powerRes = $this->getPowerByAcmeChangeArr();
        $list = [];
        foreach ($powerRes as $val){

            if($layout == "base" && $val['belong_to'] == $power['id'] && Str::contains($val['field'], 'index')){
                $list[] = $val;
            }

            if($layout == "index" && Str::before($power['field'],".") == Str::before($val['field'],".") && !Str::contains($val['field'], 'index')){
                $list[] = $val;
            }
        }
        return $list;
    }
}
