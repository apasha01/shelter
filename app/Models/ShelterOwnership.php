<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterOwnership extends Model
{
    protected $fillable = [
        'shelter_id',
        'ownership_type',
        'ownership_options',
        'property_notes',
    ];

    protected $casts = [
        'ownership_options' => 'array',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
