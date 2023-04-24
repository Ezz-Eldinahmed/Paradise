@extends('layouts.app')
@section('content')

@forelse ($notifications as $notification)

@if($notification->type == 'App\Notifications\TweetCreated')
<ul>
    <li class="list-group-item d-flex p-2">
        <img class="rounded-circle p-2" src="/default.jpg" width="20%"><br>

        {{-- <img class="rounded-circle p-2"
            src="{{($notification->data['user']['avatar']) ? '/storage/'.($notification->data['user']['avatar']): '/default.jpg'}}"
            width="20%"><br> --}}
        {{$notification->data['user']['name']}}
        Created Tweet <br>
        "{{$notification->data['body']}}"
        <br> Notification Read At
        {{$notification->read_at}}
    </li>
</ul>
@endif

@if($notification->type == 'App\Notifications\LikeHappens')
<ul>
    <li class="list-group-item d-flex p-2">
        <img class="rounded-circle p-2" src="/default.jpg" width="20%"><br>

        {{-- <img class="rounded-circle p-2" src="{{
        ($notification->data['tweet']['avatar']) 
        ? '/storage/'.($notification->data['tweet']['avatar']) 
        : '/default.jpg'}}" width="20%"> --}}
        <br>
        "{{$notification->data['user']['body']}}"
        Liked By
        {{$notification->data['tweet']['name']}}<br>
        at
        {{$notification->data['user']['created_at']}}<br>
        Read At
        {{$notification->read_at}}<br>
    </li>
</ul>
@endif

@if($notification->type == 'App\Notifications\FollowHappens')
<ul>
    <li class="list-group-item d-flex p-2">
        <img class="rounded-circle p-2" src="/default.jpg" width="20%"><br>

        {{-- <img class="rounded-circle p-2"
            src="{{($notification->data['user']['avatar']) ? '/storage/'.($notification->data['user']['avatar']): '/default.jpg'}}"
            width="20%"> --}}
        You have Followed {{$notification->data['user']['name']}}<br>
        Notification Read at {{$notification->read_at}}
    </li>
</ul>
@endif

@if($notification->type == 'App\Notifications\CommentCreated')
<ul>
    <li class="list-group-item d-flex p-2">
        <img class="rounded-circle p-2" src="/default.jpg" width="20%"><br>
        Comment Created
        "{{$notification->data['comment_body']}}"<br>
        Read At {{$notification->read_at}}
    </li>
</ul>
@endif

@empty
<h6>There Is No New Notifications</h6>
@endforelse

@endsection