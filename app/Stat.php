<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        "stats"
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
