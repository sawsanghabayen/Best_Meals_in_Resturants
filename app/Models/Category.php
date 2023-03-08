<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['*'];
    use HasFactory;
    public function meals()
    {
        return $this->hasMany(Meal::class, 'category_id', 'id');
    }

    
}
