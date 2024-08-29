<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => 'api',
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

    

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '123456789', // إضافة رقم الهاتف
            'password' => Hash::make('password12'),
        ]);

        $admin->assignRole('Admin');
    }
}
