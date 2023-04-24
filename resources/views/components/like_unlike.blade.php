<div class="d-flex p-1">
    <form method="POST" action="/tweets/{{$tweet->id}}/like">
        @csrf
        @honeypot

        {{($tweet->likes) ?: ''}}
        <button type="submit" class="btn btn-light">
            <i style="font-size:20px;
            @if($tweet->isLikedBy())
            background-color:#00c8ff;
            @endif
            " class="fa">&#xf087;</i>
        </button>
    </form>
    <form method="POST" action="/tweets/{{$tweet->id}}/dislike">
        @csrf
        @honeypot
        
        {{($tweet->dislikes) ?: ''}}
        <button type="submit" class="btn btn-light">
            <i style="font-size:20px;
                @if($tweet->isDislikedBy())
                background-color:#c73120;
                @endif
                " class="fa">&#xf165;</i>
        </button>
    </form>
</div>