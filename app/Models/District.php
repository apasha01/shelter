<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'county_id'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function shelters()
    {
        return $this->hasMany(Shelter::class);
    }
}
