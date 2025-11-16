<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterInfrastructure extends Model
{
    protected $fillable = [
        'shelter_id',
        'has_permanent_shelter',
        'permanent_shelter_count',
        'has_temporary_shelter',
        'temporary_shelter_count',
        'has_permanent_sanitation',
        'permanent_sanitation_count',
        'has_temporary_sanitation',
        'temporary_sanitation_count',
        'covered_healthy_area',
        'covered_healthy_area_min',
        'open_area_healthy',
        'open_area_healthy_min',
        'open_area_sum',
        'tent_count',
        'has_water_system',
        'has_sewage_system',
        'has_electricity_system',
        'has_gas_system',
    ];

    protected $casts = [
        'has_permanent_shelter' => 'boolean',
        'permanent_shelter_count' => 'integer',
        'has_temporary_shelter' => 'boolean',
        'temporary_shelter_count' => 'integer',
        'has_permanent_sanitation' => 'boolean',
        'permanent_sanitation_count' => 'integer',
        'has_temporary_sanitation' => 'boolean',
        'temporary_sanitation_count' => 'integer',
        'covered_healthy_area' => 'decimal:2',
        'covered_healthy_area_min' => 'decimal:2',
        'open_area_healthy' => 'decimal:2',
        'open_area_healthy_min' => 'decimal:2',
        'open_area_sum' => 'decimal:2',
        'tent_count' => 'integer',
        'has_water_system' => 'boolean',
        'has_sewage_system' => 'boolean',
        'has_electricity_system' => 'boolean',
        'has_gas_system' => 'boolean',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
