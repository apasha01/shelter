<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterCapacity extends Model
{
    protected $fillable = [
        'shelter_id',
        'healthy_area',
        'open_area',
        'emergency_indoor_capacity',
        'emergency_outdoor_capacity',
        'number_of_people',
    ];

    protected $casts = [
        'healthy_area' => 'decimal:2',
        'open_area' => 'decimal:2',
        'emergency_indoor_capacity' => 'decimal:2',
        'emergency_outdoor_capacity' => 'decimal:2',
        'number_of_people' => 'integer',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
