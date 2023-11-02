<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmployeeRoleSeeder extends Seeder
{
    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'employee']);

        $permissionIds = [18, 21]; 

        foreach ($permissionIds as $permissionId) {
            $permission = Permission::find($permissionId);

            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
