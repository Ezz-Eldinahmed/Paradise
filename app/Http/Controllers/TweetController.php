<?php

namespace App\Http\Controllers;

use App\Events\UserTweets;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function index()
    {
        return view(
            'tweets.show_Home',
            ['tweets' => auth()->user()->timeline()]
        );
    }

    public function store()
    {
        request()->validate(['body' => 'required|max:255']);
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => request('body'),
        ]);
        UserTweets::dispatch(request('body'), auth()->user());
        return redirect('/tweets')->with('success', 'Tweet Created successfully');
    }

    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', compact('tweet'));
    }

    public function update(Tweet $tweet)
    {
        $validatedAttributes =
            request()->validate([
                'body' => 'required|max:255',
                'user_id' => 'required',
            ]);
        $tweet->update($validatedAttributes);

        return redirect('/tweets')->with('success', 'Tweet updated successfully');
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
        return redirect('/tweets')->with('success', 'Tweet deleted successfully');
    }
}
