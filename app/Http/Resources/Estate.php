<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Image as ImageResource;

class Estate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'neighbourhood_id' => $this->neighbourhood_id,
            'type_id' => $this->type_id,
            'contract_id' => $this->contract_id,
            'finish_type_id' => $this->finish_type_id,
            'view_id' => $this->view_id,
            'area' => $this->area,
            'floor_number' => $this->floor_number,
            'number_of_rooms' => $this->number_of_rooms,
            'number_of_bathrooms' => $this->number_of_bathrooms,
            'number_of_living_spaces' => $this->number_of_living_spaces,
            'number_of_balconies' => $this->number_of_balconies,
            'build_year' => $this->build_year,
            'has_garage' => $this->has_garage,
            'has_elevator' => $this->has_elevator,
            'notes' => $this->notes,
            'images' => ImageResource::collection($this->images),
        ];
    }
}
