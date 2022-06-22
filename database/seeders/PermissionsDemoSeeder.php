<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user create',
            'user list',
            'user edit',
            'user delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Writer']);
        $role1->givePermissionTo('permission list');
        $role1->givePermissionTo('role list');
        $role1->givePermissionTo('user list');

        $role2 = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $role2->givePermissionTo($permission);
        }

        $role3 = Role::create(['name' => 'super-admin']);
        // Gets all permissions via Gate::before rule; see AuthServiceProvider

        // Create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com'
        ]);
        $user->assignRole($role3);

        $user2 = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com'
        ]);

        $user2->assignRole($role2);

        $user3 = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com'
        ]);
        $user3->assignRole($role1);
    }
}
