<header class="relative">
    <img src="{{($user->avatar) ? '/storage/'.($user->avatar) : '/default.jpg'}}" style="border-radius:100px;
    position: absolute;left: 250px; top: 250px;" width="150px">
    <img src="/cover.jpg" style="width:100%; max-height: 350px;">
</header>
<hr>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="container">
                <h4>
                    <i class="fa fa-user-circle-o"></i>
                    {{ $user->name }}
                </h4>
                <h4>{{ $user->email }}</h4>
                <h6>Joined At {{ $user->created_at }}</h6>
            </div>
        </div>

        <div class="offset-md-4">
            @auth
            @unless (auth()->user()->is($user))
            <form method="POST" action="/profile/{{$user->username}}/follow">
                @csrf
                <button type="submit"
                    class="btn btn-info">{{auth()->user()->following($user) ?'UnFollow' :'Follow'}}</button>
            </form>
            @endunless
            @can('update',$user,auth()->user())
            <form method="get" action="/profile/{{$user->username}}/edit">
                @csrf
                <button type="submit" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Edit</button>
            </form>
            @endcan
            @endauth
        </div>
    </div>
</div>