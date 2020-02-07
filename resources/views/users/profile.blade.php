@extends('layouts.app')

@section('content')
<div class="container">

    @if ($errors->any)
        <div class="alert alert-danger">
            <ul class=" list-group">
            @foreach ($errors->all() as $error)
                <li class=" list-group-item"> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">user profile</div>

        <div class="card-body">
            <form action=" {{route("users.update-profile" , ["user" => $user->id])}} " method="post">
            @method("PUT")
            @csrf
            <div class=" form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value=" {{$user->name}} " class="form-control">
            </div>

            <div class=" form-group">
                <label for="about">about</label>
                <Textarea class="form-control" name="about">
                    {{$user->about}}
                </Textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">update profile</button>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection
