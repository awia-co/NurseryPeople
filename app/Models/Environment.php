<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Environment extends Model
{
    use HasSlug;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function plants()
    {
        return $this->hasMany(\App\Plant::class);
    }

    public function getIconAttribute($icon)
    {
        return  asset(Storage::url($icon ?: 'images/leaf.svg'));
    }
}
