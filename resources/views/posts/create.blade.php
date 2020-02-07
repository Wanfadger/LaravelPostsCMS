@extends('layouts.app')

@section('content')


@if ($errors->any())
   <div class="alert alert-danger">
      <ul class=" list-group">
        @foreach ($errors->all() as $error)
      <li class=" list-group-item">{{$error}}</li>
        @endforeach
      </ul>
   </div>

@endif


<div class="card">


    <div class="card-header">Create Post</div>

    <div class="card-body">
        <form action=" {{ isset($post) ? route('posts.update' , ["post"=>$post->id]) : route('posts.store') }} " method="post" enctype="multipart/form-data">
            
            @if (isset($post))
                @method("put")
            @endif

            <div class=" form-group">
               <label for="title">title</label>
               <input type="text" name="title" class="form-control" value=" {{isset($post) ? $post->title : ""}} " >
            </div>

            <div class="form-group">
                <label for="description">description</label>
                <textarea name="description" id="description"  class="form-control" >
                 {{isset($post) ? $post->description : ""}}
                </textarea>
            </div>


            
            <div class="form-group">
                <label for="content">content</label>
                <input id="content" value="{{isset($post) ? $post->content : ""}}" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
                {{-- <textarea name="content" id="content"  class="form-control"></textarea> --}}
            </div>

            <div class="form-group">
                <label for="published_at">published at</label>
                <input type="text" name="published_at" id="published_at" value="{{isset($post) ? $post->published_at : ""}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class=" form-group">
                <label for="category">Select category</label>
                <select name="category" id="category" class=" form-control">
                    <option disabled selected>Select category</option>
                    @foreach ($categories as $category)
                    @if (isset($post))
                    <option value="{{$category->id}}" {{( $category->id == $post->category->id ) ? "selected" : ""}} > {{$category->name}} </option>
                        @else
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                    @endif
                        
                    @endforeach
                </select>
            </div>

            <div class=" form-group">
               
               @if ($tags->count() > 0)
               <label for="tags">Select tags</label>
               <select name="tags[] " id="tags" class=" form-control" multiple>
                <option disabled selected>Select tags</option>
                @foreach ($tags as $tag)
                @if (isset($post))
                <option value="{{$tag->id}}" {{( in_array($tag->id , $post->tags->pluck("id")->toArray())   ) ? "selected" : ""}} > {{$tag->name}} </option>
                    @else
                    <option value="{{$tag->id}}"> {{$tag->name}} </option>
                @endif
                    
                @endforeach
            </select>
               @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"> {{ isset($post) ? "edit" : "create" }} </button>
            </div>

            @csrf
        </form>
    </div>
</div>

@endsection


@section('other-css')
<link rel="stylesheet" type="text/css" href=" {{asset('/trix/dist/trix.css')}} ">
<link rel="stylesheet" href=" {{asset('/flatpickr/dist/flatpickr.min.css')}} ">
@endsection

@section('other-js')
<script type="text/javascript" src=" {{asset('/trix/dist/trix-core.js')}} "></script>
<script src=" {{asset('/trix/dist/trix.js')}} "></script>
<script src=" {{asset('/flatpickr/dist/flatpickr.min.js')}} "></script>

<script>
flatpickr('#published_at' , {
    enableTime : true
})
</script>

@endsection