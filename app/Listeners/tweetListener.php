<?php

namespace App\Listeners;

use App\Events\UserTweets;
use App\Notifications\TweetCreated;
use Illuminate\Support\Facades\Notification;

class tweetListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserTweets $event)
    {
        Notification::send(request()->user(), 
        new TweetCreated($event->body,$event->user));
    }
}
