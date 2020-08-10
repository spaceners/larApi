<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsLetter;

class newsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        if (empty($email)) {
            return response("Empty input", 402);
        } else {
            $data = NewsLetter::where("email", $email)->get()->first();
            if ($data) {
                return response("Duplicate item", 400);
            } else {
                $newsLetter = new NewsLetter;
                $newsLetter->email = filter_var($request->email, FILTER_VALIDATE_EMAIL);

                if ($newsLetter->save()) {
                    return response("Successful", 201);
                } else {
                    return response("Error", 401);
                }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
