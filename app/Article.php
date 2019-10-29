<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = "";

    /**
     * 文章分类属性
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 文章的操作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Admin::class,"operator_id");
    }

    /**
     * 文章的审查者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verifier()
    {
        return $this->belongsTo(Admin::class,"verifier_id");
    }

    /**
     * 获取模板
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * 分页获取资讯
     * @param array $data
     * @param int $limit
     * @return mixed
     */

    public function getArticleByTerm($data = [], $limit =10)
    {
        $sql = $this->makeSql($data);
        return self::where($sql)->paginate($limit);
    }

    /**
     * 做查询条件
     * @param array $data
     * @return array
     */
    private function makeSql($data = [])
    {
        $isWhere = [];
        if(!empty($data['category'])){
            $category = intval($data['category']);
            $isWhere[] = ["category_id" , $category];
        }
        if(!empty($data['state'])){
            $state = intval($data['state']);
            $isWhere[] = ["state" , $state];
        }
        if(!empty($data['startAt'])){
            $strtAt = trim($data['startAt']);
            $isWhere[] = ["created_at", ">=",$strtAt];
        }
        if(!empty($data['endAt'])){
            $endAt = trim($data['endAt']);
            $isWhere[] = ["created_at", "<=",$endAt];
        }
        if(!empty($data['title'])){
            $title = trim($data['title']);
            $isWhere[] = ["title", $title];
        }
        if(!empty($data['me'])){
            $isWhere[] = ["operator_id", session()->get("admin_id")];
        }
        return $isWhere;
    }
}
