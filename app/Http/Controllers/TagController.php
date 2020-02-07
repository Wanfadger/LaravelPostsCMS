<?php

namespace App\Http\Controllers;

use App\models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
      return view('tags.index' , compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            "name" => "required|unique:tags"
        ]);

        Tag::create($data);
        session()->flash("success" , "tag successfully created");
        return redirect()->route('tags.index');
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
    public function edit(Tag $tag)
    {
        return view("tags.create" , compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag)
    {
        $data = request()->validate([
            "name" => "required|unique:tags"
        ]);

        $tag->update($data);
        session()->flash("success" , "Tag successfully updated");
      return  redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            session()->flash("error" , "Tag cannot be deleted becouse its associated with some posts");
            return redirect()->back();
        }

        $tag->delete();
        session()->flash("success" , "succssfully deleted");
       return redirect()->route('tags.index');
    }
}
