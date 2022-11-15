<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Country extends Model
{
    use HasSlug;

    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
