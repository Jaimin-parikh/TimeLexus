<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public const UPDATED_AT   =   null;
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
