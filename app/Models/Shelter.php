<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{

    protected $fillable = [
        'name',
        'province_id',
        'county_id',
        'city_id',
        'village_name',
        'address',
        'latitude',
        'longitude',
        'postal_code',
        'shelter_type',
        'notes',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function contact()
    {
        return $this->hasOne(ShelterContact::class);
    }

    public function accessibility()
    {
        return $this->hasOne(ShelterAccessibility::class);
    }

    public function capacity()
    {
        return $this->hasOne(ShelterCapacity::class);
    }

    public function infrastructure()
    {
        return $this->hasOne(ShelterInfrastructure::class);
    }

    public function facility()
    {
        return $this->hasOne(ShelterFacility::class);
    }

    public function healthcare()
    {
        return $this->hasOne(ShelterHealthcare::class);
    }

    public function land()
    {
        return $this->hasOne(ShelterLand::class);
    }

    public function ownership()
    {
        return $this->hasOne(ShelterOwnership::class);
    }
}

