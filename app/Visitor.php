<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use SoftDeletes;
    
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
        'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
 
    /**
     * The events that belong to the visitor.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
