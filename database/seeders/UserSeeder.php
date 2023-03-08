<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'maria',
            'email'=>'maria@gmail.com',
            'password'=>Hash::make(12345),
            'mobile'=>'0597085978',
            'gender'=>'female',
            

        ]);
    
}
}
