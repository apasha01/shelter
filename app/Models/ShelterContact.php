<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShelterContact extends Model
{
    protected $fillable = [
        'shelter_id',
        'manager_mobile_1',
        'manager_mobile_2',
        'manager_mobile_3',
        'manager_vip_1',
        'manager_vip_2',
        'manager_vip_3',
        'manager_phone_1',
        'manager_phone_2',
        'manager_phone_3',
    ];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }
}
