<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class State extends Model
{
    use  HasSlug;
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/companies/locations/'.$this->slug;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'locations')->distinct();
    }
}
