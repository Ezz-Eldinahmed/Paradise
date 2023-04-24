@can('update', $tweet)
<div class="d-flex">
  <a href="{{route('tweets.edit',$tweet)}}" class="btn btn-success btn-sm rounded-1" type="submit"><i
      class="fa fa-edit"></i></a>
  @endcan

  @can('delete', $tweet)
  <a class="btn btn-danger btn-sm rounded-1" onclick="return confirm('Are you sure you want to delete this tweet?')"
    href="{{route('tweets.destroy',$tweet)}}"><i class="fa fa-trash"></i></a>
</div>
@endcan