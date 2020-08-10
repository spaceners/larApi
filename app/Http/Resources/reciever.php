<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class reciever extends JsonResource
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
    }
}


// "id": 1,
// "companyName": "ScrapMoni",
// "agentName": "Ada",
// "email": "obi@gmail.com",
// "website": "scrapmoni.com",
// "address": "204 egelehe onitsha",
// "city": "G;eta",
// "state": "Calif",
// "country": "USA",
// "zipcode": "12345",
// "phoneNumber": "2344321111",
// "electronics": true,
// "biological": false,
// "collector": false,
// "userName": "obinna",
// "password": "Password1!",
// "passwordConfirm": "Password1!",
// "mobile": true,
// "paying": true,
// "private": false,
// "selling": false,
// "created_at": "2020-05-27 16:46:51",
// "updated_at": "2020-05-27 20:32:33"
