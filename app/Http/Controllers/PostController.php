<?php

namespace App\Http\Controllers;

use App\models\Category;
use App\models\Post;
use App\models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
     
        $this->middleware("verifyCategoriesCount")->only("create" ,"store");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
      
        return view("posts.index" , compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
       
        return view("posts.create" , compact("categories" , "tags"));
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
            "title" => "required|unique:posts" ,
            "content" => "required" ,
            "description" => "required" ,
            "image" => "required|image" ,
            "published_at" => ""
        ]);
      
        //upload image
        $image = request('image')->store("posts");
        $data["image"] = $image;
        $data["category_id"] = request("category");
        $post = Post::create($data);
         
        if(request()->tags){
            $post->tags()->attach(request()->tags);
        }
       
     
        session()->flash("success" , "Posts successfully created");
        return redirect()->route("posts.index");
    
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
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
      
        return view('posts.create' , compact("post" , "categories" , "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {

        if(request()->hasFile("image")){
            //upload
             $image = request()->image->store("posts");
            //delete old one
            Storage::delete($post->image);
        }

        $data = request()->validate([
            "title" => "required|unique:posts" ,
            "content" => "required" ,
            "description" => "required" ,
            "published_at" => ""
        ]);

        $data["image"] = $image;

        $post->update($data);

         session()->flash("success" , "post updated successfully");
       return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where("id" , $id)->firstOrFail();
       
        if($post->trashed()){
           
            Storage::delete($post->image);
         $post->forceDelete();
        }else{
            $post->delete();
        }
        
        session()->flash("success" , "posts successfully deleted");
        return redirect()->route('posts.index');
    }


     /**
     * display a list of trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
         $posts = Post::onlyTrashed()->get();
     
         return view("posts.index" , compact("posts"));
    }


    
     /**
     * display a list of trashed posts and posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Post $post){
        

        $post->restore();
        session()->flash("success" , "post successfully restored");
         return redirect()->back();
   }



}
