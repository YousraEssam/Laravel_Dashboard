<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMember extends Model
{
    use SoftDeletes;
    protected $with= ['user'];
    /**
     * to override delete behaviour
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function ($staffMember) {
                $staffMember->user()->delete();
                $staffMember->image()->delete();
            }
        );
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'role_id', 'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the job that owns the staff member.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Get the role that owns the staff member.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
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
    
    /**
     * Get the news for the staffmember.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * The folder that belong to the staff member.
     */
    public function folders()
    {
        return $this->belongsToMany(Folder::class);
    }
}
