<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded =[];

    public function Articles()
    {
        return $this->hasMany(Article::class);
    }
}
