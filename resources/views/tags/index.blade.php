@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-end">
    <a class=" btn btn-sm btn-success " href=" {{route('tags.create')}} ">Add tag</a>
</div>

<div class="card mt-2">
    <div class="card-header ">
        <h4>tags</h4>
    </div>

    <div class="card-body">
        @if ($tags->count() > 0)
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
                @foreach ($tags as $tag)
                    <tr>
                    <td>{{$tag->name}}</td>
                    <td> {{$tag->posts->count()}} </td>
                    <td><a href=" {{route('tags.edit' , ["tag" => $tag->id])}} " class="btn btn-primary btn-sm">update</a></td>
                     <td>
                      <form action="  {{route('tags.delete' , ["tag"=>$tag->id])}} " method="post">
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
            <h4 class="text-center">No tags Yet</h4>
        @endif
    </div>

</div>
    
@endsection

