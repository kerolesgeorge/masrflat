<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];

    // Estates relationship
    public function estates()
    {
        return $this->hasMany(Estate::class);
    }

}
