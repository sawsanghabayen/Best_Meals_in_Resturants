<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'sawsan',
            'mobile'=>'0597085978',
            'email'=>'sawsan@gmail.com',
            'gender'=>'F',
            'password'=>Hash::make(12345),

        ]
            
        );
    }
}
