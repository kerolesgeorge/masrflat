<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['name'];

    public function neighbourhoods()
    {
        return $this->hasMany(Neighbourhood::class);
    }
}
