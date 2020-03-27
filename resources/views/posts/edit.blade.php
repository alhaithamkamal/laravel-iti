@extends('layouts.app')
@section('content')
<div class="container">
    <form class="my-3" method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
        <label >Title</label>
        <input name="title" type="text" class="form-control" aria-describedby="emailHelp" value="{{$post->title}}">
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" class="form-control">{{$post->describtion}}</textarea>
        </div>

        <div class="form-group">
        <label for="exampleInputPassword1">Users</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)  
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Uplad Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection