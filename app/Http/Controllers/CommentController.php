<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index(Post $post)
    {
        return $post->comments()->latest()->paginate(20);
    }

    /**
     * Persist a new reply.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        if ($post->locked) {
            return response('Post is locked and cannot be replied to.', 422);
        }

        return $reply = $post->addComment([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ])->load('author');
    }

    public function update(Comment $comment)
    {
        //uses the comment policy to see if can update comment.
        $this->authorize('update', $comment);
        $data = request()->validate(['body' => 'required|spamfree']);
        $comment->update($data);
    }

    public function destroy(Comment $comment)
    {
        //uses the comment policy to see if can destroy comment.
        $this->authorize('update', $comment);

        $comment->delete();

        //for ajax requests:
        if (request()->expectsJson()) {
            return response(['status' => 'Comment Deleted']);
        }

        return back();
    }
}
