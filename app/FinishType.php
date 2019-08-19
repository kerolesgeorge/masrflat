<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishType extends Model
{
    //protected $table = "finish_types";
    protected $fillable = ['name'];

    // Estates relationship
    public function estates()
    {
        return $this->hasMany(Estate::class);
    }
}
