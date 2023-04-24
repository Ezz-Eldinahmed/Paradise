@extends('layouts.app')
@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('info'))
    <div class="alert alert-info">
        {{ session()->get('info') }}
    </div>
@endif

<x-profile_header :user="$user" />

@auth
<x-create_tweet />

@include('tweets.show_profile')  
  
@endauth

@endsection