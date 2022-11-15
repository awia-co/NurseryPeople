<?php

namespace App\Models;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Favoritable, RecordsActivity;
    protected $guarded = [];
    protected $appends = ['isFavorited'];
    protected $with = ['author', 'favorites'];

    protected static function boot()
    {
        parent::boot();

        //adds and deletes comments_count on creating/deleting reply.
        static::created(function ($comment) {
            $comment->commentable->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->commentable->decrement('comments_count');
            $comment->favorites->each->delete();
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany(self::class, 'commentable');
    }

    /**
     * Fetch all mentioned users within the reply's body.
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }

    public function path()
    {
        return $this->commentable->path();
    }

    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace('/@([\w\S\-]+)/ ', '<a href="/profiles/$1">$0</a>', $body);
    }
}
