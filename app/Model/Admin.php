<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    const ADMIN_STATE_ON = 1;
    const ADMIN_STATE_OFF = 0;

    protected $guarded = [];

    public function adminRole()
    {
        return $this->belongsTo(Role::class,"role");
    }

    /**
     * 操作人员的文章
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operatorArticle()
    {
        return $this->hasMany(Article::class,"operator_id");
    }
}
