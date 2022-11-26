<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PlantCategory extends Model
{
    use HasSlug;
    protected $table = 'plant_categories';
    protected $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)->doNotGenerateSlugsOnUpdate();
    }

    public function plants()
    {
        return $this->hasMany(Plant::class, 'plant_category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/plant-categories/'.$this->slug;
    }

    public function getIconAttribute($icon)
    {
        return  asset(Storage::url($icon ?: 'images/leaf.svg'));
    }
}
