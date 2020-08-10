<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\recycle;
use App\Http\Controllers\Controller;
use App\Http\Resources\Recycle as RecycleResources;

class recycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recycle = Recycle::orderBy('id', 'DESC')->paginate(12);

        return RecycleResources::collection($recycle);
    }

    public function getByCat($category)
    {
        $giver = Recycle::orderBy("zipcode")->where('category', '=', $category)->paginate(4);

        return RecycleResources::collection($giver);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path1 = null;
        $path2 = null;
        $path3 = null;
        $path4 = null;
        $path5 = null;
        $path6 = null;
        $name1 = "";
        $name2 = "";
        $name3 = "";
        $name4 = "";
        $name5 = "";
        $name6 = "";

        if ($request->file('avatar1') !== null) {
            $name1 = $request->file('avatar1')->getClientOriginalName();
            $path1 = $request->file('avatar1')->storeAs("public", $name1);
        }
        if ($request->file('avatar2') !== null) {
            $name2 = $request->file('avatar2')->getClientOriginalName();
            $path2 = $request->file('avatar2')->storeAs("public", $name2);;
        }
        if ($request->file('avatar3') !== null) {
            $name3 = $request->file('avatar3')->getClientOriginalName();
            $path3 = $request->file('avatar3')->storeAs("public", $name3);;
        }
        if ($request->file('avatar4') !== null) {
            $name4 = $request->file('avatar4')->getClientOriginalName();
            $path4 = $request->file('avatar4')->storeAs("public", $name4);;
        }
        if ($request->file('avatar5') !== null) {
            $name5 = $request->file('avatar5')->getClientOriginalName();
            $path5 = $request->file('avatar5')->storeAs("public", $name5);;
        }
        if ($request->file('avatar6') !== null) {
            $name6 = $request->file('avatar6')->getClientOriginalName();
            $path6 = $request->file('avatar6')->storeAs("public", $name6);;
        }
        $recycle = $request->isMethod('put') ?
            Recycle::findOrFail($request->id) : new Recycle;

        if (!empty($request->file('avatar1'))) {
            $recycle->id = $request->input('id');
            $recycle->itemName = htmlspecialchars(trim($request->input('itemName')));
            $recycle->itemDescription = htmlspecialchars(trim($request->input('itemDescription')));
            $recycle->category = htmlspecialchars(trim($request->input('category')));
            $recycle->phoneNumber = htmlspecialchars(trim($request->input('phoneNumber')));
            $recycle->address = htmlspecialchars(trim($request->input('address')));
            $recycle->city = htmlspecialchars(trim($request->input('city')));
            $recycle->state = htmlspecialchars(trim($request->input('state')));
            $recycle->country = htmlspecialchars(trim($request->input('country')));
            $recycle->zipcode = htmlspecialchars(trim($request->input('zipcode')));
            $recycle->duration = htmlspecialchars(trim($request->input('duration')));
            $recycle->avatar1 = $name1;
            $recycle->avatar2 = $name2;
            $recycle->avatar3 = $name3;
            $recycle->avatar4 = $name4;
            $recycle->avatar5 = $name5;
            $recycle->avatar6 = $name6;

            if ($recycle->save()) {
                return new RecycleResources($recycle);
            }
        } else {
            return "Incomplete data";
        }
    }
    public function search($category,$searchWord)
    {
        $query=htmlspecialchars(trim($searchWord));
        $data = Recycle::where("category", $category)
            ->where("itemName", "like", "%{$query}%")
            ->paginate(4);
        return new RecycleResources($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recycle = Recycle::findOrFail($id);

        return new RecycleResources($recycle);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recycle = Recycle::findOrFail($id);

        if ($recycle->delete()) {
            return new RecycleResources($recycle);
        } else {
            return "Record not deleted";
        }
    }
}
