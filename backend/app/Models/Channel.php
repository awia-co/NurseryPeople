<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Channel extends Model
{
    use HasSlug;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)->doNotGenerateSlugsOnUpdate();
    }

    protected $guarded = [];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function path()
    {
        return '/channels/'.$this->slug;
    }
}
