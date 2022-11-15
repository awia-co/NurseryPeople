<?php

namespace App\Models;

use App\Notifications\PostWasCommentedOn;
use Illuminate\Database\Eloquent\Model;

class PostSubscription extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function notify($comment)
    {
        $this->user->notify(new PostWasCommentedOn($this->post, $comment));
    }
}
