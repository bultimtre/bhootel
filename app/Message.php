<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "body",
        "title",
        "email"
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
