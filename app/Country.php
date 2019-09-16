<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Get the cities for the country
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
