<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;
    const MALE = 'Male';
    const FEMALE = 'Female';
    public static $types = [self::MALE, self::FEMALE];
    /**
     * to override delete behaviour
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function ($visitor) {
                $visitor->user()->delete();
                $visitor->image()->delete();
            }
        );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'city_id', 'gender', 'user_id', 'is_active'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the country that owns the staff member.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the city that owns the staff member.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the user that owns the staff member
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff member's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
}
