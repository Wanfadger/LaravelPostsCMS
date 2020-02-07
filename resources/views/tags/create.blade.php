@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
        <h4>{{ isset($tag) ? "Edit Tag" : "Create tag"}}</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class=" list-group">
                    @foreach ($errors->all() as $error)
                <li class=" list-group-item text-danger">{{$error}}</li>
                    @endforeach
                </ul> 
            </div>
            
            @endif

            <form action=" {{isset($tag) ? route('tags.update' , ["tag" => $tag->id]) :  route('tags.store')  }}   " method="post">
               
                @if (isset($tag))
                    @method("put")
                @endif

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" value=" {{isset($tag) ? $tag->name : ""}} " class="form-control">    
                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-sm btn-primary"> {{isset($tag) ? "edit" : "create"}} </button>
                </div>
                @csrf
            </form>
        </div>

    </div>
@endsection

