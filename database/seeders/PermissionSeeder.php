<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
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
        'complete-order',
        
        'view-user',
        'create-user',
        'update-user',
        'delete-user',

        
        'view-statistic',
        'create-statistic',
        'update-statistic',
        'delete-statistic',
        
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists to avoid duplication
            $existingPermission = Permission::where('name', $permission)->where('guard_name', 'api')->first();

            if (!$existingPermission) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }
    }
}
