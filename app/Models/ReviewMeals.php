<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewMeals extends Model
{
    use HasFactory;

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id', 'id');
    }
    // public function ordermeal()
    // {
    //     return $this->belongsTo(Order_Meal::class, 'order_meal_id', 'id');
    // }
    // public function order()
    // {
    //     return $this->belongsTo(Order::class, 'order_id', 'id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
