<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function getActiveStatusAttribute(){
        return $this->active ? 'Active' : 'Disabled';
    }


    public function resturants()
    {
        return $this->hasMany(Resturant::class, 'city_id', 'id');
    }
   
}

