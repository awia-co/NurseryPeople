<?php

namespace App\Models;

use App\Traits\Favoritable;
use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plant extends Model
{
    use Searchable, Favoritable, Reviewable, HasSlug, Actionable;
    // protected $with = ['favorites', 'reviews'];
    //add to json count of favorites for vue component.
    // protected $appends = ['isFavorited', 'rating', 'isReviewed', 'userReview', 'companies_count', 'reviews_count'];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($plant) {
            $plant->reviews->each->delete();
        });
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(150);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function path()
    {
        return "/plants/{$this->slug}";
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(PlantCategory::class, 'plant_category_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    public function zone()
    {
        return $this->belongsTo(ClimateZone::class, 'climate_zone_id');
    }

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];

        return $array;
    }

    public function getCompaniesCountAttribute()
    {
        return $this->companies()->count();
    }

    public function getReviewsCountAttribute()
    {
        return$this->reviews()->count();
    }
}
