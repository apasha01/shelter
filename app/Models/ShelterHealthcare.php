<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterHealthcare extends Model
{
    protected $fillable = [
        'shelter_id',
        'healthcare_service_count',
        'healthcare_team_count',
        'has_mobile_clinic',
        'has_fixed_clinic',
        'has_emergency_room',
        'has_hospitalization',
        'accessibility_to_construction',
        'facilities_for_healthcare',
    ];

    protected $casts = [
        'healthcare_service_count' => 'integer',
        'healthcare_team_count' => 'integer',
        'has_mobile_clinic' => 'boolean',
        'has_fixed_clinic' => 'boolean',
        'has_emergency_room' => 'boolean',
        'has_hospitalization' => 'boolean',
        'accessibility_to_construction' => 'boolean',
        'facilities_for_healthcare' => 'boolean',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
