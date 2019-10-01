<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id',
    ];

     /**
     * Get the post that owns the comment.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function staffMembers()
    {
        return $this->hasMany(StaffMember::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
