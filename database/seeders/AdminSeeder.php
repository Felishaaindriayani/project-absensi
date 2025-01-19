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
        $create_user = Permission::create(['name' => 'create_user']);
        $edit_user = Permission::create(['name' => 'edit_user']);
        $read_user = Permission::create(['name' => 'read_user']);
        $delete_user = Permission::create(['name' => 'delete_user']);

        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);
        $kepsek = Role::create(['name' => 'kepsek']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole('admin');

    }
}

