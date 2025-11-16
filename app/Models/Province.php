<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    public function counties()
    {
        return $this->hasMany(County::class);
    }

    public function shelters()
    {
        return $this->hasMany(Shelter::class);
    }
}
