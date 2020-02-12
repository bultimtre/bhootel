<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'description', 
        'image', 
        'address', 
        'lat', 
        'lon', 
        'rooms', 
        'beds', 
        'bath', 
        'square_mt', 
        'show'    
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function configs()
    {
        return $this->belongsToMany(Config::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
