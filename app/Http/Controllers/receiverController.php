<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receiver;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\reciever as receiverResource;
use Geocodio\Geocodio;

class receiverController extends Controller
{
    // public function __construct(Geocodio $geocoder)
    // {
    //     $this->goecoder = $geocoder;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receiver = Receiver::orderBy("zipcode")->paginate(24);

        return receiverResource::collection($receiver);
    }

    public function getRecByCat($category)
    {
        $receiver = Receiver::orderBy("zipcode")->where('category', '=', $category)->paginate(9);

        return receiverResource::collection($receiver);
    }

    public function login(Request $request)
    {
        $userName = htmlspecialchars(trim($request->input('userName')));
        $password = htmlspecialchars(trim($request->input('password')));
        $user = Receiver::where('userName', $userName)->get()->first();
        if ($user && Hash::check($password, $user->password)) // The passwords match...
        {
            $response = ['success' => true, 'data' => ['id' => $user->id, 'userName' => $user->userName, 'email' => $user->email, 'agentName' => $user->agentName]];
        } else
            $response = ['success' => false, 'data' => 'User Name or Password is incorrect'];


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

        $data = Receiver::where('userName', $userName)->get()->first();

        if ($data) {
            return response("Item Duplicate", 408);
        } else {
            $receiver = $request->isMethod('put') ?
                Receiver::findOrFail($request->id) : new Receiver;

            if ($request->input('password') === $request->input('passwordConfirm')) {
                if (!empty($request->input('agentName')) && !empty($request->input('userName'))) {
                    $receiver->id = $request->input('id');
                    $receiver->companyName = htmlspecialchars(trim($request->input('companyName')));
                    $receiver->agentName = htmlspecialchars(trim($request->input('agentName')));
                    $receiver->email = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL);
                    $receiver->website = htmlspecialchars(trim($request->input('website')));
                    $receiver->address = htmlspecialchars(trim($request->input('address')));
                    $receiver->city = htmlspecialchars(trim($request->input('city')));
                    $receiver->state = htmlspecialchars(trim($request->input('state')));
                    $receiver->country = htmlspecialchars(trim($request->input('country')));
                    $receiver->zipcode = htmlspecialchars(trim($request->input('zipcode')));
                    $receiver->phoneNumber = htmlspecialchars(trim($request->input('phoneNumber')));
                    $receiver->category = htmlspecialchars(trim($request->input('category')));
                    $receiver->userName = htmlspecialchars(trim($request->input('userName')));
                    $receiver->password = Hash::make($request->input('password'));
                    $receiver->passwordConfirm = Hash::make($request->input('passwordConfirm'));
                    $receiver->mobile = $request->input('mobile');
                    $receiver->paying = $request->input('paying');
                    $receiver->private = $request->input('private');
                    $receiver->selling = $request->input('selling');


                    if ($receiver->save()) {
                        return new receiverResource($receiver);
                    }
                } else {
                    return response("Incomplete Data", 402);
                }
            } else {
                return response("Password must match", 404);
            }
        }
    }
    public function search($category, $query)
    {
        $data = htmlspecialchars(trim($query));

        $receiver = Receiver::where("category", $category)
            ->where(function ($receive) use ($data){
                $receive->where("companyName", "like", "%{$data}%")
                    ->orWhere("agentName", "like", "%{$data}%")
                    ->orWhere("city", "like", "%{$data}%");
            })
            ->paginate(9);
        return new receiverResource($receiver);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receiver = Receiver::findOrFail($id);

        return new receiverResource($receiver);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receiver = Receiver::findOrFail($id);

        if ($receiver->delete()) {
            return new receiverResource($receiver);
        }
    }
}
