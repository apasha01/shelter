<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'district_id', 'type'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function shelters()
    {
        return $this->hasMany(Shelter::class);
    }
}
