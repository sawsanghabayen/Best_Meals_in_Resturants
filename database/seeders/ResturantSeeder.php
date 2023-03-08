<?php

namespace Database\Seeders;

use App\Models\Resturant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResturantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resturant::create([
            'name'=>'sawsan',
            'mobile'=>'0597085978',
            'telephone'=>'2470333',
            'email'=>'sawsan@gmail.com',
            'password'=>Hash::make(12345),
            'address'=>'mashroo3',
            'city_id'=>'1'

        ]
  
            
        );
    }
}
