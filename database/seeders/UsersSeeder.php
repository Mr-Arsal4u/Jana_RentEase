<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class   UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'owner' => 'Owner',
            'renter' => 'Renter',
            'admin' => 'Admin',
        ];
    
        foreach ($roles as $roleName => $roleLabel) {
            Role::create(['name' => $roleLabel]);
        }
    
        // Assuming createOwner, createRenter, and createAdmin methods exist and take a role name as parameter
        $this->createOwner($roles['owner']);
        $this->createRenter($roles['renter']);
        $this->createAdmin($roles['admin']);
    }
    

    private function createOwner($role)
    {
        $user = User::create([
            'name' => 'property owner',
            'email' => 'owner@123.com',
            'password' => bcrypt('password'),

        ]);
        $user->assignRole($role);
    }

    private function createRenter($role)
    {
        $user = User::create([
            'name' => 'property renter',
            'email' => 'renter@123.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role);
    }

    private function createAdmin($role)
    {
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@123.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role);
    }
}
