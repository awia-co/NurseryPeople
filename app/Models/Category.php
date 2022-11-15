<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;
    protected $guarded = [];
    protected $table = 'company_categories';

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/categories/'.$this->slug;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_category', 'company_category_id', 'company_id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)->doNotGenerateSlugsOnUpdate();
    }
}
