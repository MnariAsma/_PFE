<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immobilier extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Syndicat(){
        return $this->belongsTo(Syndicat::class,"syndicat_id");
    }
    public function appartement(){
        return $this->hasMany(Appartement::class,"immobilier_id");
    }
    public function event(){
        return $this->hasMany(Event::class,"immobilier_id");
    }
    public function copropriete(){
        return $this->hasMany(copropriete::class,"immobilier_id");
    }
}
