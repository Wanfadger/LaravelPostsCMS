@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href=" {{route('posts.create')}} " class="btn btn-sm btn-success">Add Post</a>
    </div>

    <div class="card">
        <div class="card-header">
            ({{$posts->count()}})Posts
        </div>
        <div class="card-body">
          @if ($posts->count() > 0)
          <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                     <td> <img src="{{asset($post->image)}}" alt="post image" width="50px" height="50px"> </td>
                    <td>{{$post->title}}</td>
                    <td> {{$post->category->name}} </td>
                    <td>
                        @if ($post->trashed())
                        <form action=" {{route("posts.restore" , ["post" => $post->id] )}}" method="post">
                            @method("put")
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">restore</button>
                            </form>
                     
                        @else
                        <a href=" {{route("posts.edit" , ["post" => $post->id ])}} " class="btn btn-primary btn-sm">edit </a> 
                        @endif
                       
                     </td>
                    
                     <td>
                         <form action=" {{route('posts.delete' , ['post' => $post->id])}} " method="post">
                             @method("delete")
                             @csrf
                             <button type="submit" class="btn btn-danger btn-sm">{{ ($post->trashed()) ? "delete" : "trash" }}</button>
                             </form>
                     </td>
                    </tr>

                @endforeach
            </tbody>

        </table>
          @else
              <h4 class="text-center">NO POSTS YET</h4>
          @endif
        </div>
    </div>

@endsection