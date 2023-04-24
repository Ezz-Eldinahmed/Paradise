<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\CommentCreated;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate(['comment_body' => 'required|max:255']);
        Comment::create([
            'user_id' => auth()->id(),
            'tweet_id' => request('tweet_id'),
            'comment_body' => request('comment_body'),
        ]);
        
        Notification::send(request()->user(), 
        new CommentCreated(
            auth()->id(),
            request('comment_body'), 
            request('tweet_id')));
        return redirect('/tweets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment)
    {
        $validatedAttributes =
            request()->validate([
                'comment_body' => 'required|max:255',
            ]);
        $comment->update($validatedAttributes);

        return redirect('/tweets')->with('success', 'Tweet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/tweets')->with('success', 'Comment deleted successfully');
    }
}
