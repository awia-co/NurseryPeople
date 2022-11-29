<?php

namespace App\Traits;

use App\Review;

trait Reviewable
{
    protected static function bootReviewable()
    {
        static::deleting(function ($model) {
            $model->reviews->each->delete();
        });
    }

    /**
     * A item can be reviewed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function getRatingAttribute()
    {
        if ($this->reviews->count() != 0) {
            return $this->reviews->avg('rating');
        } else {
            return 0;
        }
    }

    public function addReview($review)
    {
        if (! $this->isReviewed()) {
            $review = $this->reviews()->create($review);

            return $review;
        } else {
            abort('403', "Sorry, you've already left a review on this item.");
        }
    }

    public function isReviewed()
    {
        return (bool) $this->reviews->where('user_id', auth()->id())->count();
    }

    public function getIsReviewedAttribute()
    {
        return $this->isReviewed();
    }

    public function userReview()
    {
        return $this->reviews->where('user_id', auth()->id())->first();
    }

    public function getUserReviewAttribute()
    {
        return $this->userReview();
    }
}
