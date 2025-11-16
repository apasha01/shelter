<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterAccessibility extends Model
{
    protected $fillable = [
        'shelter_id',
        'usage_types',
        'public_service_types',
        'accessibility_features',
        'distance_to_market',
        'distance_to_railway',
        'distance_to_main_street',
        'distance_to_highway',
    ];

    protected $casts = [
        'usage_types' => 'array',
        'public_service_types' => 'array',
        'accessibility_features' => 'array',
        'distance_to_market' => 'decimal:2',
        'distance_to_railway' => 'decimal:2',
        'distance_to_main_street' => 'decimal:2',
        'distance_to_highway' => 'decimal:2',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
