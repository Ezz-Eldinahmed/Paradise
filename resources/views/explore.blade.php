@extends('layouts.app')
@section('content')

@if(session()->has('info'))
<div class="alert alert-info">
    {{ session()->get('info') }}
</div>
@endif
@forelse ($users as $user)
<li class="list-group-item sm" style="background-color: #00C4FF; color:white">
    <div class="d-flex">
        <img class="rounded-circle" src="{{($user->avatar) ? '/storage/'.($user->avatar) : '/default.jpg'}}"
            width="20%" />
        <div class="col-sm-9">
            <a href="{{route('profile', $user->username)}}"><b>{{$user->username}}</b></a><br />
            <b>{{$user->name}}</b><br />
            <b>{{$user->email}}</b><br />
            @auth
            @unless (auth()->user()->is($user))
            <form method="POST" action="/profile/{{$user->username}}/follow">
                @csrf
                <button type="submit"
                    class="btn btn-light mt-3"><i class="fa fa-user-o"></i>&nbsp;
                    {{auth()->user()->following($user) ?'UnFollow' :'Follow'}}</button>
            </form>
            @endunless
            @endauth
        </div>
    </div>
</li>

@empty
<p>you have not follow anyone yet</p>
@endforelse

<x-pagination_home :tweets='$users' />

@endsection