<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{
    protected $fillable = ['name', 'city_id'];

    // Cities relationship
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Estates relationship
    public function estates()
    {
        return $this->hasMany(Estate::class);
    }
}
