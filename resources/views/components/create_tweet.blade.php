<form class="text-center border border-light" method="POST" action="/tweets">
    @csrf
    @honeypot

    <div class="form-group">
        <div class="d-flex p-2">
            <img class="rounded-circle p-1"
                src="{{(auth()->user()->avatar) ? '/storage/'.(auth()->user()->avatar) : '/default.jpg'}}" width="15%">
            <textarea style="border-color: #14b5ff" name="body"
                class="form-control @error('body') alert alert-danger @enderror" rows="3"
                placeholder="Write Your Post Here !!" required>{{old('body')}}</textarea>
            @error('body')
            <p class="text-danger">{{$message}}</p>
            @enderror

            <button style="width: 20%;" class="btn btn-outline-primary ml-2" type="submit">Share With Other
            </button>
        </div>
    </div>
</form>