<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Create roles
         $adminRole = Role::create(['name' => 'Admin']);

         // Define permissions
         $permissions = [
             'create-user',
             'read-user',
             'update-user',
             'delete-user',
         ];
 
         // Assign permissions to the Admin role
         foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
             $adminRole->givePermissionTo($permission);
         }
    }
}
