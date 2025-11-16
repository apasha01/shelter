<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterLand extends Model
{
    protected $fillable = [
        'shelter_id',
        'soil_slope',
        'soil_quality',
        'is_wet_land',
        'is_swampy',
        'land_exit_for_animals',
        'land_accommodation_for_animals',
    ];

    protected $casts = [
        'soil_slope' => 'decimal:2',
        'is_wet_land' => 'boolean',
        'is_swampy' => 'boolean',
        'land_exit_for_animals' => 'boolean',
        'land_accommodation_for_animals' => 'boolean',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
