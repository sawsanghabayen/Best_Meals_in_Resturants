<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meal extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function resturant()
    {
        return $this->belongsTo(Resturant::class, 'resturant_id', 'id');
    }
    
    public function ordermeals()
    {
        return $this->hasMany(OrderMeal::class, 'meal_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, OrderMeal::class,'meal_id','order_id');
    }

    
    public function reviewmeals()
    {
        return $this->hasMany(ReviewMeals::class, 'meal_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, Favorite::class, 'meal_id', 'user_id');
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'meal_id', 'id');
    }
    public function userscart()
    {
        return $this->belongsToMany(User::class, Cart::class, 'meal_id', 'user_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'meal_id', 'id');
    }
    public function getIsFavoriteAttribute()
    {
        if (auth('user')->check()) {
         
            return $this->favorites()->where('user_id', auth('user')->id())->exists();
        }
        return false;

    }
    public function getAvgRatingAttribute()
    {
       
         
            return substr($this->reviewmeals()->avg('rate') , 0,3);
         

    }
    public function getNumReviewsAttribute()
    {
       
         
            return substr($this->reviewmeals()->count('meal_id') , 0,1);
         

    }
    
}
