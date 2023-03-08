<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeal extends Model
{
    use HasFactory;


      
    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    // public function orderreviews()
    // {
    //     return $this->hasMany(Order_Review::class, 'order_meal_id', 'id');
    // }
    
}
