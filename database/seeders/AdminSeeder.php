<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
     {
        $create_user = Permission::firstOrCreate(['name' => 'create_user']);
        $edit_user = Permission::firstOrCreate(['name' => 'edit_user']);
        $read_user = Permission::firstOrCreate(['name' => 'read_user']);
        $delete_user = Permission::firstOrCreate(['name' => 'delete_user']);

        $create_kehadiran = Permission::firstOrCreate(['name' => 'create_kehadiran']);
        $read_kehadiran = Permission::firstOrCreate(['name' => 'read_kehadiran']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([$create_user, $read_user, $edit_user, $delete_user, $read_kehadiran]);

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions([$create_kehadiran, $read_kehadiran, $read_user]);

        $user = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        if (!$user->hasRole('admin')) {
            $user->assignRole('user');

        }
        

    }
}

