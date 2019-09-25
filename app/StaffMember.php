<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMember extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'role_id', 'job_id', 'country_id', 'city_id', 'gender', 'user_id'
        //  'isActive'
    ];

    /**
     * Get the job that owns the staff member.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

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
}
