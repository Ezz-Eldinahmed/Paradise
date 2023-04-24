<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Notifications\LikeHappens;
use Illuminate\Support\Facades\Notification;

class LikesController extends Controller
{
    public function Like(Tweet $tweet)
    {
        if ($tweet->isLikedBy()) {
            $tweet->removeLike(auth()->user());
        } else if ($tweet->isDislikedBy()) {
            $tweet->removeDislike(auth()->user());
            $tweet->like(auth()->user());
            Notification::send(request()->user(), new LikeHappens($tweet,auth()->user()));
        } else {
            $tweet->like(auth()->user());
            Notification::send(request()->user(), new LikeHappens($tweet,auth()->user()));
        }
        return back();
    }

    public function disLike(Tweet $tweet)
    {
        if ($tweet->isDislikedBy()) {
            $tweet->removeDislike(auth()->user());
        } else if ($tweet->isLikedBy()) {
            $tweet->removeLike(auth()->user());
            $tweet->dislike(auth()->user());
        } else {
            $tweet->dislike(auth()->user());
        }
        return back();
    }
}
