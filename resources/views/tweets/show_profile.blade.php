@foreach ($user->tweets as $tweet)
<div class="card">
    <div class="card-header d-flex">
        Last Updated At {{$tweet->updated_at}}
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-6">
                <div class="d-flex">
                    <img class="rounded-circle"
                        src="{{($tweet->user->avatar) ? '/storage/'.($tweet->user->avatar) : '/default.jpg'}}"
                        width="25%" height="25%">
                    <h5 class="ml-3">{{ $tweet->body }}</h5>
                </div>
                <x-like_unlike :tweet="$tweet" />
            </div>

            <div class="col-5 ml-5 float-right">
                <footer class="blockquote-footer">Created_at <cite title="Source Title">{{$tweet->created_at}}</cite>
                </footer>
                <div class="m-2 float-right">
                    <x-edit_tweet :tweet="$tweet" />
                </div>
            </div>
        </div>
    </div>

    @include('comments.show')

    @include('comments.create')
</div>

@endforeach