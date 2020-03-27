@extends('layouts.app')
@section('content')
<div class="container text-center">
<a href="{{ route('posts.create') }}" class="btn btn-success my-3">Create Post</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Slug</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      <td>{{ $post->slug }}</td>
      <td>{{ $post->user->name }}</td>
      <td>{{ $post->created_at->format('Y/m/d') }}</td>
      <td>
        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-info">View</a>
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" class="d-inline">
          @method('DELETE') @csrf
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $posts->links() }}
</div>
@endsection