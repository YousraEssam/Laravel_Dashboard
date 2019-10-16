<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    /**
     * to override delete behaviour
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function ($news) {
                $news->images()->delete();
                $news->files()->delete();
            }
        );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_title', 'secondary_title', 'content', 'type', 'author_id', 'is_published'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the staffmember that owns the news.
     */
    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class, 'author_id');
    }

    /**
     * Get all of the news's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get all of the news's files.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Get all related news
     */
    public function related()
    {
        return $this->belongsToMany(Related::class, 'related', 'news_id', 'related_id');
    }

    /**
     * Scope a query to only include published enws.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query) : void
    {
        $query->whereIsPublished(True);
    }
}
