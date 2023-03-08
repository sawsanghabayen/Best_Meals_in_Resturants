<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //************************ADMIN PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

       

        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);
        
        // Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Resturant', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Resturants', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Resturant', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Resturant', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Update-Order', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'admin']);


        // Permission::create(['name' => 'Create-Meal', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Meals', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Meal', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Meal', 'guard_name' => 'admin']);






        //************************Resturant PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'resturant']);


        // Permission::create(['name' => 'Create-City', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Update-City', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Delete-City', 'guard_name' => 'resturant']);

        Permission::create(['name' => 'Create-Meal', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Read-Meals', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Update-Meal', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Delete-Meal', 'guard_name' => 'resturant']);

        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Read-Resturants', 'guard_name' => 'resturant']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'resturant']);



        // Permission::create(['name' => 'Read-Orders', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Update-Order', 'guard_name' => 'resturant']);
        // Permission::create(['name' => 'Delete-Order', 'guard_name' => 'resturant']);


      
    }
}

