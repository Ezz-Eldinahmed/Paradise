@extends('layouts.app')
@section('content')
<form class="text-center border border-light p-3" method="POST" action="/tweets/{{$comment->id}}/update">
    @csrf
    @honeypot
    @method('put')
    <div class="form-group">
        <div class="d-flex p-2">
            <img class="rounded-circle"
                src="{{(auth()->user()->avatar) ? '/storage/'.(auth()->user()->avatar) : '/default.jpg'}}" width="15%">
            <textarea style="border-color: #89cff0" name="comment_body" class="form-control rounded-5 
                @error('comment_body') alert alert-danger @enderror" rows="1"
                placeholder="Write Your Comment Here">{{$comment->comment_body}}</textarea>

            <button class="btn btn-outline-secondary btn-rounded p-2" type="submit">
                Edit Comment
            </button>
        </div>
        @error('comment_body')
        <p class="text-danger p-2">{{$message}}</p>
        @enderror
    </div>
    <!-- Send button -->
</form>
@endsection