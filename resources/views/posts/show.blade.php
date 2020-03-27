@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="d-inline card-title">Title :- </h5>{{ $post->title }}
            <h5 class="card-text">Description :- </h5>{{ $post->describtion }}.
            @if($post->image)
            <img src="{{asset('storage/'.$post->image)}}" class="card-img-top" alt="image">
            @endif
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="d-inline card-title">Name :- </h5>{{ $post->user->name }}
            <br>
            <h5 class="d-inline card-title">Email :- </h5>{{ $post->user->email }}
            <br>
            <h5 class="d-inline card-title">Created At :- </h5>{{ $post->user->getCreatedAtAttribute() }}
        </div>
    </div>
</div>
@endsection