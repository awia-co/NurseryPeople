<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Stock extends Model
{
    use HasSlug;
    protected $guarded = [];
    protected $table = 'stocks';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/stock/'.$this->slug;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'nursery_stock');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)->doNotGenerateSlugsOnUpdate();
    }

    public function getIconPathAttribute($icon)
    {
        return  asset(Storage::url($icon ?: '/images/leaf.svg'));
    }
}
