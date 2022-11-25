<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Feature extends Model
{
    use HasSlug;
    protected $guarded = [];

    public function plants()
    {
        return $this->belongsToMany(\App\Plant::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function path()
    {
        return '/features/'.$this->slug.'/plants';
    }
}
