<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterFacility extends Model
{
    protected $fillable = [
        'shelter_id',
        'has_sanitation_facilities',
        'has_sports_facilities',
        'has_children_welfare_facilities',
        'has_women_welfare_facilities',
        'has_sports_facilities_infrastructure',
        'has_medical_equipment_storage',
    ];

    protected $casts = [
        'has_sanitation_facilities' => 'boolean',
        'has_sports_facilities' => 'boolean',
        'has_children_welfare_facilities' => 'boolean',
        'has_women_welfare_facilities' => 'boolean',
        'has_sports_facilities_infrastructure' => 'boolean',
        'has_medical_equipment_storage' => 'boolean',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
