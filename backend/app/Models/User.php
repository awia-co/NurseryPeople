<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable
{
    use HasSlug;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    /**
     * Get the path to the user's avatar. This overides the column path.
     *
     * @param  string $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        if ($avatar) {
            return  asset(Storage::url($avatar));
        } else {
            return  asset('avatars/profile.svg');
        }
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function isAdmin()
    {
        return in_array($this->email, ['chris@solmediaco.com', 'cwray@gardengatetrees.com', 'ro_bles20@hotmail.com']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isCompanyAdmin($company)
    {
        return $this->companies()->exists($company);
    }

    public function favoritePlants()
    {
        return $this->morphedByMany(Plant::class, 'favorited', 'favorites');
    }

    public function favoriteCompanies()
    {
        return $this->morphedByMany(Company::class, 'favorited', 'favorites');
    }
}
