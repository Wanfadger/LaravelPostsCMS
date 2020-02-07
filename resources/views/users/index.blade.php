@extends('layouts.app')


@section('content')


<div class="card mt-2">
    <div class="card-header ">
        <h4>users</h4>
    </div>

    <div class="card-body">
        @if ($users->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>email</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                 @foreach ($users as $user)
                  <tr>
                      <td>image</td>
                      <td> {{$user->name}} </td>
                      <td> {{$user->email}} </td>
                      <td> <button class="btn btn-info btn-sm"> {{ $user->isAdmin() ? "admin" : "writer" }} </button> </td>
                      @if (!$user->isAdmin() )
                      <td> <form action=" {{route("users.make-admin" , ["user" => $user->id])}} " method="post">
                        <button class="btn btn-warning btn-sm" type="submit">make admin</button>
                        @csrf
                       @method("put")      
                    </form> </td>
                      @endif
                  </tr>
                 @endforeach
            </tbody>
        </table>
        @else
            <h4 class="text-center">No users Yet</h4>
        @endif
    </div>

</div>
    
@endsection

