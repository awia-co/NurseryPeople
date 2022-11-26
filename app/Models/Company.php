<?php

namespace App\Models;

use App\Filters\CompanyFilters;
use App\Traits\Favoritable;
use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use Searchable, Reviewable, HasSlug, Actionable, Favoritable;
    protected $appends = ['favoritesCount', 'isFavorited', 'isAdmin', 'rating', 'isReviewed', 'userReview', 'rating', 'plants_count', 'locations_count', 'reviews_count'];
    protected $with = ['reviews', 'favorites'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function path()
    {
        if ($this->is_nursery == 1) {
            return '/nurseries/'.$this->slug;
        }

        return '/companies/'.$this->slug;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function scopeFilter($query, CompanyFilters $filters)
    {
        return $filters->apply($query);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class);
    }

    public function getIsAdminAttribute()
    {
        return (bool) $this->admins()->where('user_id', auth()->id())->count();
    }

    public function getLogoPathAttribute($logo)
    {
        return  asset(Storage::url($logo ?: '/logos/default.svg'));
    }

    public function getPlantsCountAttribute()
    {
        return $this->plants()->count();
    }

    public function getLocationsCountAttribute()
    {
        return $this->locations()->count();
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function plants()
    {
        return $this->belongsToMany(Plant::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function states()
    {
        return $this->belongsToMany(State::class, 'locations');
    }

    public function mainLocation()
    {
        return $this->belongsTo(Location::class, 'main_location_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_category', 'company_id', 'company_category_id');
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'nursery_stock');
    }

    public function isNursery()
    {
        if ($this->is_nursery == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function hasLocations()
    {
        if ($this->locations != null) {
            return true;
        } else {
            return false;
        }
    }

    public function isMainLocation($location)
    {
        if ($this->mainLocation != null && $location->id == $this->mainLocation->id) {
            return true;
        }

        return false;
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
}
