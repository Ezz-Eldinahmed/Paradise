<br>
<form class="text-center border border-light" method="POST" action="/tweets/{{$tweet->id}}/comment">
    @csrf
    @honeypot

    <div class="form-group">
        <div class="d-flex p-1">
            <img class="rounded-circle"
                src="{{(auth()->user()->avatar) ? '/storage/'.(auth()->user()->avatar) : '/default.jpg'}}" height="10%"
                width="10%"><textarea required style="border-color: #89cff0" name="comment_body" class="form-control 
                @error('comment_body') alert alert-danger @enderror"
                placeholder="Write Your Comment Here">{{old('comment_body')}}</textarea>
            <input hidden type="text" name="tweet_id" value="{{$tweet->id}}">

            <button class="btn btn-warning btn-rounded" type="submit">
                <i class='fa fa-comment'></i> Comment
            </button>
        </div>
        @error('comment_body')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <!-- Send button -->
</form>