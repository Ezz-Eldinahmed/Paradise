@extends('layouts.app')

@section('content')
<form class="text-center border border-light p-3" method="POST" action="/tweets/{{$tweet->id}}">
    @csrf
    @method('PUT')
    @honeypot
    <div class="form-group">
        <div class="d-flex p-2">
            <img class="rounded-circle"
                src="{{(auth()->user()->avatar) ? '/storage/'.(auth()->user()->avatar) : '/default.jpg'}}" height="15%"
                width="15%">
            <textarea style="border-color: #89cff0" name="body" rows="3"
                class="form-control rounded-5 @error('body') alert alert-danger @enderror"
                required>{{$tweet->body}}</textarea>
            @error('body')
            <p class="text-danger p-1">{{$message}}</p>
            @enderror

            <input hidden value="{{Auth::id()}}" name="user_id">
            <input hidden value="{{$tweet->id}}" name="tweet_id">

            <button class="btn btn-outline-secondary btn-rounded ml-1" type="submit">Edit
            </button>
        </div>
    </div>
</form>
@endsection