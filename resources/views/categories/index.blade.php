@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-end">
    <a class=" btn btn-sm btn-success " href=" {{route('categories.create')}} ">Add category</a>
</div>

<div class="card mt-2">
    <div class="card-header ">
        <h4>Categories</h4>
    </div>

    <div class="card-body">
        @if ($categories->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>post count</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                    <td>{{$category->name}}</td>
                    <td> {{$category->posts->count()}} </td>
                    <td><a href=" {{route('categories.edit' , ["category" => $category->id])}} " class="btn btn-primary btn-sm">update</a></td>
                     <td>
                      <form action="  {{route('categories.delete' , ["category"=>$category->id])}} " method="post">
                          @csrf
                          @method("delete")
                          <button type="submit" class="btn btn-danger">delete</button>
                      </form>
                    </td>    
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h4 class="text-center">No Categories Yet</h4>
        @endif
    </div>

</div>
    
@endsection

