<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Recycle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     "id" => $this->id,
        //     "itemName" => $this->itemName,
        //     "itemDescription" => $this->itemDescription,
        //     "category" => $this->category,
        //     "phoneNumber" => $this->phoneNumber,
        //     "address" => $this->address,
        //     "city" => $this->city,
        //     "state" => $this->state,
        //     "country" => $this->country,
        //     "zipcode" => $this->zipcode,
        //     "duration" => $this->duration,
        //     "avatar1" => asset($this->avatar1),
        //     "avatar2" => asset($this->avatar2),
        //     "avatar3" => asset($this->avatar3),
        //     "avatar4" => asset($this->avatar4),
        //     "avatar5" => asset($this->avatar5),
        //     "avatar6" => asset($this->avatar6)
        // ];
    }
}
