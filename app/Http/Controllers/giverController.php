<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Giver;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Giver as GiverResources;

class giverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giver = Giver::orderBy("zipcode")->paginate(12);

        return GiverResources::collection($giver);
    }

    public function login(Request $request)
    {
        $userName = htmlspecialchars(trim($request->input('userName')));
        $password = htmlspecialchars(trim($request->input('password')));
        $user = Giver::where('userName', $userName)->get()->first();
        if ($user && Hash::check($password, $user->password)) // The passwords match...
        {
            $response = ['success' => true, 'data' => ['id' => $user->id, 'userName' => $user->userName, 'email' => $user->email, 'agentName' => $user->name]];
        } else
            $response = ['success' => false, 'data' => 'User Name or Password is Incorrect'];


        return response()->json($response, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userName = htmlspecialchars(trim($request->input('userName')));

        $data = Giver::where('userName', $userName)->get()->first();

        if ($data) {
            return response("Item Duplicate",408);
        } else {
            $giver =  $request->isMethod('put') ?
                Giver::findOrFail($request->id) : new Giver;

            if ($request->input('password') === $request->input('passwordConfirm')) {
                if (
                    !empty($request->input('name')) &&
                    !empty($request->input('email')) &&
                    !empty($request->input('phoneNumber')) &&
                    !empty($request->input('userName')) &&
                    !empty($request->input('password')) &&
                    !empty($request->input('address'))
                ) {
                    $giver->id = $request->input('id');
                    $giver->name = htmlspecialchars(trim($request->input('name')));
                    $giver->email = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL);
                    $giver->phoneNumber = htmlspecialchars(trim($request->input('phoneNumber')));
                    $giver->address = htmlspecialchars(trim($request->input('address')));
                    $giver->city = htmlspecialchars(trim($request->input('city')));
                    $giver->state = htmlspecialchars(trim($request->input('state')));
                    $giver->country = htmlspecialchars(trim($request->input('country')));
                    $giver->zipcode = htmlspecialchars(trim($request->input('zipcode')));
                    $giver->mobile = $request->input('mobile');
                    $giver->selling = $request->input('selling');
                    $giver->userName = htmlspecialchars(trim($request->input('userName')));
                    $giver->password = Hash::make($request->input('password'));
                    $giver->passwordConfirm = Hash::make($request->input('passwordConfirm'));

                    if ($giver->save()) {
                        return new GiverResources($giver);
                    }
                } else {
                    return response("Incomplete Data",402);
                }
            } else {
                return response("Password must match passwordConfirm",404);
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
        $giver = Giver::findOrFail($id);

        return new GiverResources($giver);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giver = Giver::findOrFail($id);
        if ($giver->delete()) {
            return new GiverResources($giver);
        } else {
            return "Record not deleted";
        }
    }
}
