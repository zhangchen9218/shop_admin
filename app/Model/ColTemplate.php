<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ColTemplate extends Model
{
    //
    protected $guarded = [];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
