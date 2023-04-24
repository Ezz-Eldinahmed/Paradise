<div class="sidebar-right">
    <div class="sidebar">
        @auth
        <div class="sidebar-heading">
            <h3><b>Following</b></h3>
        </div>
        @forelse (auth()->user()->follows->take(8) as $user)
        <li class="list-group-item sm" style="background-color: aliceblue;">
            <div class="d-flex">
                <img class="rounded-circle" src="{{($user->avatar) ? '/storage/'.($user->avatar) : '/default.jpg'}}"
                    width="50px" />
                <div class="flex-box p-2">
                    <a href="{{route('profile', $user->username)}}">
                        {{$user->name}}<br />
                        <b>{{$user->username}}</a><br />
                </div>
            </div>
        </li>
        @empty
        <p>You Aren't Following Anyone Yet</p>
        @endforelse
        @endauth
    </div>
</div>