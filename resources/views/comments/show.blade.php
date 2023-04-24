@forelse ($tweet->comment as $comment)
<br>
<span class="card">
    <div class="p-1">
        <div class="d-flex p-1">
            <img class="rounded-circle"
                src="{{($comment->user->avatar) ? '/storage/'.($comment->user->avatar) : '/default.jpg'}}" height="8%"
                width="8%">
            <p class="ml-2">Commented By <b>{{($comment->user->name)}}</b></p>
            <h5 class="ml-2">"{{($comment->comment_body)}}"</h5>
        </div>
        <div class="clearfix">
            <div class="float-right">
                @can('update', $comment)
                <a href="{{route('comment.edited',$comment->id)}}" class="btn btn-dark btn-sm rounded-1"
                    type="submit"><i class="fa fa-edit"></i></a>
                @endcan

                @can('delete', $comment)
                <a class="btn btn-info btn-sm rounded-1"
                    onclick="return confirm('Are you sure you want to delete this comment?')"
                    href="/tweets/{{$comment->id}}/delete">
                    <i class="fa fa-trash"></i>
                </a>
                @endcan

                <footer class="blockquote-footer float-left mr-2">Created_at <cite
                        title="Source Title">{{($comment->created_at)}}</cite>
                </footer>
            </div>
        </div>
    </div>
</span>
@empty

@endforelse