<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Role');

        DB::table('roles')->insert([
            'name' => 'Roles',
            'display_name' => 'Roles',
            'description' => 'Roles',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $roleId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'name' => 'roles.index',
            'display_name' => 'Role Index',
            'description' => 'Role Index',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'roles.create',
            'display_name' => 'Role Create',
            'description' => 'Role Create',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'roles.edit',
            'display_name' => 'Role Edit',
            'description' => 'Role Edit',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);
    }
}