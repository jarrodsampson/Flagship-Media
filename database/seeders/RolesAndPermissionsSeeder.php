<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'view']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'editor'])->givePermissionTo(['view', 'edit', 'delete']);
        Role::create(['name' => 'contributor'])->givePermissionTo(['view', 'edit']);
        Role::create(['name' => 'viewer'])->givePermissionTo(['view']);
    }
}
