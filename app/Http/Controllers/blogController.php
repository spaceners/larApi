<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\blog;
use App\Http\Resources\blog as BlogResources;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = blog::orderBy("created_at")->get();

        return BlogResources::collection($blog);
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
        $blog = $request->isMethod('PUT') ?
        blog::findOrfail($request->id): new blog;

        $blog->author = htmlspecialchars(trim($request->author));
        $blog->title = htmlspecialchars(trim($request->title));
        $blog->description = htmlspecialchars(trim($request->description));
        $blog->body = htmlspecialchars(trim($request->body));

        if($blog->save()){
            return new BlogResources($blog);
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
        $blog = blog::findOrFail($id);
        return new BlogResources($blog);
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
        $blog = blog::findOrFail($id);
        if ($blog->delete()) {
            return new BlogResources($blog);
        } else {
            return "Record not deleted";
        }
    }
}
