<?php

namespace App\Models;

use App\Events\PostReceivedNewReply;
use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug, RecordsActivity, Searchable, Favoritable;
    protected $with = ['favorites'];
    protected $appends = ['isSubscribedTo', 'isFavorited'];
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->comments->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function path()
    {
        return '/posts/'.$this->slug;
    }

    public function subscriptions()
    {
        return $this->hasMany(PostSubscription::class);
    }

    public function subscribe()
    {
        $this->subscriptions()->create([
            'user_id' => auth()->id(),
        ]);

        return $this;
    }

    public function unsubscribe()
    {
        $this->subscriptions()
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function addComment($comment)
    {
        $comment = $this->comments()->create($comment);

        event(new PostReceivedNewReply($comment));

        return $comment;
    }
}
