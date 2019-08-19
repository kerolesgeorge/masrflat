<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['name'];

    // Estates relationship
    public function estates()
    {
        return $this->hasMany(Estate::class);
    }

}
