<?php

namespace App;

use Illuminate\Support\Facades\Auth;

trait Likeable
{
    public function scopeWithLikes($query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes , sum(disliked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function removeLike($user = null)
    {
        return $this->liked()->updateOrCreate(
            ['user_id' => $user ? $user->id : Auth::user()],
            ['liked' => 0]
        );
    }

    public function removeDislike($user = null)
    {
        return $this->disliked()->updateOrCreate(
            ['user_id' => $user ? $user->id : Auth::user()],
            ['disliked' => 0],
        );
    }

    public function like($user = null)
    {
        return $this->liked()->updateOrCreate([
            'user_id' => $user ? $user->id : Auth::user()
        ], ['liked' => 1]);
    }

    public function dislike($user = null)
    {
        return $this->disliked()->updateOrCreate([
            'user_id' => $user ? $user->id : Auth::user()
        ], ['disliked' => 1]);
    }

    public function isLikedBy()
    {
        return (bool)
        $this->liked()
            ->where('user_id', auth()->user()->id)
            ->where('liked', 1)
            ->count();
    }

    public function isDislikedBy()
    {
        return (bool)
        $this->disliked()
            ->where('user_id', auth()->user()->id)
            ->where('disliked', 1)
            ->count();
    }
}
