<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class copropriete extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function immobilier(){
        return $this->belongsTo(Immobilier::class,"immobilier_id");
    }
    public function service(){
        return $this->hasMany(Service::class,'copropriete_id');
    }
}
