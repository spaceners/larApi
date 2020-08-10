<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coordinates;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Coordinates as CoordinatesResources;

class coordinatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($latitude,$longitude)
    {
        $query = Coordinates::distance($latitude,$longitude);
        $cordinates = $query->orderBy('distance', 'ASC')->get();

        return CoordinatesResources::collection($cordinates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userName = $request->input('userName');

        $data = Coordinates::where('userName', $userName)->get()->first();

        if ($data) {
           return response("Item Duplicate",400);
        } else {
            $cordinates =  $request->isMethod('put') ?
            Coordinates::findOrFail($request->id) : new Coordinates;

        $cordinates->id = $request->input('id');
        $cordinates->userName = $request->input('userName');
        $cordinates->companyName = $request->input('companyName');
        $cordinates->agentName = $request->input('agentName');
        $cordinates->address = $request->input('address');
        $cordinates->city = $request->input('city');
        $cordinates->state = $request->input('state');
        $cordinates->category = $request->input('category');
        $cordinates->latitude = $request->input('latitude');
        $cordinates->longitude = $request->input('longitude');
        $cordinates->zipcode = $request->input('zipcode');

        if ($cordinates->save()) {
            return new CoordinatesResources($cordinates);
        }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giver = Coordinates::findOrFail($id);
        if($giver->delete()){
        return new CoordinatesResources($giver);
        }else{
            return "Record not deleted";
        }
    }
}
