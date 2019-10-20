<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    /**
     * to override delete behaviour
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function ($event) {
                $event->images()->delete();
            }
        );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_title', 'secondary_title', 'content', 'start_date', 'end_date', 'location', 'is_published'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the event's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * The visitors that belong to the event.
     */
    public function visitors()
    {
        return $this->belongsToMany(Visitor::class)->with('user');
    }
}
