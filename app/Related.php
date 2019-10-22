<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Related extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'news_id', 'related_id'
    ];

    /**
     * Get all news 
     */
    public function news()
    {
        return $this->belongsToMany(News::class, 'related', 'related_id', 'news_id');
    }
}
