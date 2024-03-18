<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syndicat extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'phone_number',
    //     'email',
    //     'cities_id',
    //     'address',
    //     'password'
    // ];
    protected $guarded = [];
    public function immobilier(){
        return $this->hasMany(Immobilier::class,'syndicat_id');
    }
}
