<?php

namespace App\Http\Controllers;

use App\models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
      return view('categories.index' , compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
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
            "name" => "required|unique:categories"
        ]);

        Category::create($data);
        session()->flash("success" , "category successfully created");
        return redirect()->route('categories.index');
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
    public function edit(Category $category)
    {
        return view("categories.create" , compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        $data = request()->validate([
            "name" => "required|unique:categories"
        ]);

        $category->update($data);
        session()->flash("success" , "Category successfully updated");
      return  redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if($category->posts->count()>0){
            session()->flash("error" , "category cannot be deleted, becouse its asscoiated with some posts");
           return redirect()->back();
        }

        $category->delete();
       return redirect()->route('categories.index');
    
    }
}
