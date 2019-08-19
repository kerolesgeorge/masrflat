<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = [
        'neighbourhood_id',
        'type_id',
        'contract_id',
        'view_id',
        'finish_type_id',
        'area',
        'floor_number',
        'number_of_rooms',
        'number_of_bathrooms',
        'number_of_living_spaces',
        'number_of_balconies',
        'build_year',
        'has_garage',
        'has_elevator',
        'notes'
    ];

    /**
     * Define relationships
     * <i class="fas fa-signal-3    "></i>
     */
    public function neighbourhood()
    {
        return $this->belongsTo(Neighbourhood::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function finishType()
    {
        return $this->belongsTo(FinishType::class);
    }

    public function view()
    {
        return $this->belongsTo(View::class);
    }

}
