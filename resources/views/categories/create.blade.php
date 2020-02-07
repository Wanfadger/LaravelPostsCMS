@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
        <h4>{{ isset($category) ? "Edit Category" : "Create Category"}}</h4>
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

            <form action=" {{isset($category) ? route('categories.update' , ["category" => $category->id]) :  route('categories.store')  }}   " method="post">
               
                @if (isset($category))
                    @method("put")
                @endif

                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" value=" {{isset($category) ? $category->name : ""}} " class="form-control">    
                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-sm btn-primary"> {{isset($category) ? "edit" : "create"}} </button>
                </div>
                @csrf
            </form>
        </div>

    </div>
@endsection

