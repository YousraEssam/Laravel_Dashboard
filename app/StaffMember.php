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
        'image', 'first_name', 'last_name', 'email', 'phone', 'role_id', 'job_id', 'country_id', 'city_id', 'gender', 'isActive'
    ];

    /**
     * Get the job that owns the staff member.
     */
    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    /**
     * Get the country that owns the staff member.
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * Get the city that owns the staff member.
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * Get the role that owns the staff member.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
