<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // create permissions for each modules defined in system
        $modules = [
            'currencies', 'countries', 'zones', 'geo zones', 'taxes', 'stores', 'file manager', 'informations', 'manufacturers', 'categories', 'options', 'products', 'customers', 'customer groups'
        ];

        $adminPermissions = [];
        foreach ($modules as $module) {
            $viewPermission = Permission::firstOrCreate(['name' => 'view '. $module]);
            $viewAllPermission = Permission::firstOrCreate(['name' => 'view all '. $module]);
            $editPermission = Permission::firstOrCreate(['name' => 'edit '. $module]);
            $deletePermission = Permission::firstOrCreate(['name' => 'delete '. $module]);
            $publishPermission = Permission::firstOrCreate(['name' => 'publish '. $module]);
            $unpublishPermission = Permission::firstOrCreate(['name' => 'unpublish '. $module]);

            $adminPermissions[] = $viewPermission;
            $adminPermissions[] = $viewPermission;
            $adminPermissions[] = $viewAllPermission;
            $adminPermissions[] = $editPermission;
            $adminPermissions[] = $deletePermission;
            $adminPermissions[] = $publishPermission;
            $adminPermissions[] = $unpublishPermission;
        }

        $adminRole->syncPermissions($adminPermissions);
    }
}
