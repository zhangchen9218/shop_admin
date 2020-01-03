<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Column extends Model
{
    protected $guarded = [];

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function template(){
        return $this->hasMany(ColTemplate::class);
    }

    public function seo(){
        return $this->hasOne(Seo::class);
    }

    /**
     * 获取栏目树
     * @param int $pid
     * @param int $state
     * @return mixed
     */
    public function getColumnTree($pid = 0, $state = 0){
        $term[] = ["pid",$pid];
        if($state){
            $term[] = ["state",$state];
        }

        $columns = self::where($term)->get();
        if($columns){
            foreach($columns as &$column) {
                $subset = $this->getColumnTree($column->id , $state);
                if(collect($subset)->isNotEmpty()){
                    $column['subset'] = $subset;
                }
            }
        }
        return $columns;
    }

    /**
     * 获取栏目子类id
     * @param int $pid
     * @return array
     */
    public function getColumnSubsetId($pid = 0){
        $term[] = ["pid",$pid];
        $columnIds = self::where($term)->pluck("id");
        if($columnIds){
            $tempArr = $columnIds;
            foreach($tempArr as &$id) {
                $subset = $this->getColumnSubsetId($id);
                if(collect($subset)->isNotEmpty()){
                    $columnIds = Arr::collapse([$columnIds ,$subset]);
                }
            }
        }
        return $columnIds;
    }

    /**
     * @param $id
     * @param int $carry
     * @return string
     */
    public function getColumnParentId($id){
        $info = self::find($id);
        if($info->pid){
            $tmpe = $this->getColumnParentId($info->pid);
            $id = $id.",".$tmpe;
        }
        return $id;
    }

    public function getColumnTreeByDate($search)
    {
        $columns = self::where("name","like","%".$search."%")->orWhere("id",$search)->get();

        return $columns;
    }
}
