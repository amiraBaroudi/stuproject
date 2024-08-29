<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Stuff',
            'guard_name' => 'api',
        ]);

      
        $StuffPermissions = [
            'view-veichle',
            'create-veichle',
            'update-veichle',
            'delete-veichle',
            'view-driver',
            'create-driver',
            'update-driver',
            'delete-driver',
            'view-furniture',
            'create-furniture',
            'update-furniture',
            'delete-furniture',
            'view-order',
            'create-order',
            'update-order',
            'delete-order',
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'view-statistic',
            'create-statistic',
            'update-statistic',
            'delete-statistic',
            'complete-order',
            
        ];

        foreach ($StuffPermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->where('guard_name', 'api')->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }

        $stuff1 = User::create([
            'name' => 'Driver One',
            'email' => 'driver1@example.com',
            'phone_number' => '987654321',
            'password' => Hash::make('password1'),
        ]);

        // إنشاء المستخدم الثاني
        $stuff2 = User::create([
            'name' => 'Driver Two',
            'email' => 'driver2@example.com',
            'phone_number' => '123123123',
            'password' => Hash::make('password2'),
        ]);

        // إسناد دور Stuff للمستخدمين
        $stuff1->assignRole('Stuff');
        $stuff2->assignRole('Stuff');
    }
}
