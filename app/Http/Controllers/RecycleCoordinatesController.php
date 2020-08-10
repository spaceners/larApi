<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\recycleCoordinates;
use App\Http\Resources\RecycleCoordinates as CoordinatesResources;

class RecycleCoordinatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($latitude,$longitude)
    {
        $query = recycleCoordinates::distance($latitude,$longitude);
        $cordinates = $query->orderBy('distance', 'ASC')->get();

        return CoordinatesResources::collection($cordinates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemId = $request->input('itemId');

        $data = recycleCoordinates::where('itemId', $itemId)->get()->first();

        if ($data) {
           return response("Item Duplicate",400);
        } else {
            $cordinates =  $request->isMethod('put') ?
            recycleCoordinates::findOrFail($request->id) : new recycleCoordinates;

        $cordinates->id = $request->input('id');
        $cordinates->itemName = $request->input('itemName');
        $cordinates->latitude = $request->input('latitude');
        $cordinates->longitude = $request->input('longitude');
        $cordinates->address = $request->input('address');
        $cordinates->city = $request->input('city');
        $cordinates->state = $request->input('state');
        $cordinates->zipcode = $request->input('zipcode');
        $cordinates->image = $request->input('image');
        $cordinates->itemId = $request->input('itemId');

        if ($cordinates->save()) {
            return new CoordinatesResources($cordinates);
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giver = recycleCoordinates::findOrFail($id);
        if($giver->delete()){
        return new CoordinatesResources($giver);
        }else{
            return "Record not deleted";
        }
    }
}
