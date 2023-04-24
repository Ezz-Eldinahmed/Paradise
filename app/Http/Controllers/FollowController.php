<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FollowHappens;
use Illuminate\Support\Facades\Notification;

class FollowController extends Controller
{
    public function store(User $user)
    {
        if (auth()->user()->following($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->follow($user);
            Notification::send(request()->user(), new FollowHappens($user));
        }

        $alert = '';
        if (auth()->user()->following($user)) {
            $alert = 'Followed';
        } else {
            $alert = 'UnFollowed';
        }
        return back()->with('info', 'You Have ' . $alert . ' ' . $user->name);
    }
}
