@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img  src="{{ $user->profile->profileImage() }}" alt=""  class="rounded-circle w-100"/>
        </div>
        <div class="col-9 pt-5">
            <div Class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{$user->username}} </div>
                  <div id="follow-button" userID="{{$user->id}}" follows="{{$follows}}"></div>
                </div>
                @can('update', $user->profile)
                    <a href="/post/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)

              <a href="/profile/{{$user->id}}/edit">Edit Profile</a>   
            @endcan
            <div class="d-flex">
                <div class="pr-4"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div  class="pr-4"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                <div><strong>{{$user->following->count()}}</strong> followings</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="http://adekunlea.com/">{{ $user->profile->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post )
            <div class="col-4 pb-4">
                <a href="/post/{{$post->id}}">
                    <img  src="/storage/{{$post->image}}" alt=""  class="w-100"/>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
