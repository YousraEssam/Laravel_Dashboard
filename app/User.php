<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    const MALE = 'Male';
    const FEMALE = 'Female';
    public static $types = [self::MALE, self::FEMALE];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'gender', 'country_id', 'city_id', 'is_active'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Always hash password using mutator when we save it to the database
     */
    // public function setPasswordAttribute($value) {
    //     return $this->attributes['password'] = Hash::make($value);
    // }

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
      * Get the staff member record associated with the user.
      */
    public function staff()
    {
        return $this->hasOne(StaffMember::class);
    }

    /**
     * Get the visitor record associated with the user.
     */
    public function visitor()
    {
        return $this->hasOne(Visitor::class);
    }
    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
