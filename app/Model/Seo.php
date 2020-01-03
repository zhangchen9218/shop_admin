<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
