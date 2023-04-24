<div class="list-group">
    @auth
    <b>
        <h3 class="container">
            <a href="{{route('profile', Auth::user())}}">
                <i class="fa fa-user-circle-o"></i>
                &nbsp;{{Auth::user()->name }}
            </a>
        </h3>
    </b>
    @endauth
    {{-- {{Request::path()==='home' ? 'active' : ''}} --}}
    <a href="/home" class="list-group-item list-group-item-action bg-light">
        <i class="fa fa-home"></i>&nbsp;
        HOME
    </a>
    <a href="/explore" class="list-group-item list-group-item-action bg-light">
        <i class="fa fa-search"></i>&nbsp;
        Explore
    </a>
    <a href="/tweets" class="list-group-item list-group-item-action bg-light">
        <i class="fa fa-paper-plane-o"></i>&nbsp;
        Tweets
    </a>
    @guest
    <a class="list-group-item list-group-item-action bg-light" href="{{ route('login') }}">
        <i class="fa fa-sign-in"></i>&nbsp;
        {{ __('Login') }}
    </a>
    <a class="list-group-item list-group-item-action bg-light" href="{{ route('register') }}">
        <i class="fa fa-registered"></i>&nbsp;
        {{ __('Register') }}
    </a>
    @endguest

    @auth
    <a href="/Notifications" class="list-group-item list-group-item-action bg-light">
        <i class="fa fa-bell"></i>&nbsp;
        Notifications
    </a>
    <a href="{{route('profile', Auth::user())}}"
        class="list-group-item list-group-item-action bg-light">
        <i class="fa fa-user-circle-o"></i>&nbsp;
        {{ Auth::user()->name }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <a class="list-group-item list-group-item-action bg-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i style="transform: rotate(180deg);" class="fa fa-sign-out"></i>
            &nbsp;{{ __('Logout') }}
        </a>
    </form>
    @endauth
</div>