<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'id';

    /**
     * Get the cities for the country
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the staff members for the country.
     */
    public function staffMembers()
    {
        return $this->hasMany(StaffMember::class);
    }

    /**
     * Get the staff members for the country.
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
