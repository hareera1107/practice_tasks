<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        
        // or may be done by chaining
        $role = Role::create(['name' => 'writer'])->givePermissionTo([
            'create posts',
            'edit posts',
        ]);

        $role = Role::create(['name' => 'user']);
    }
}
