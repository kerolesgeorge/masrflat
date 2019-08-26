<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
