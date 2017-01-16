<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PermissionTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Permission');

        DB::table('roles')->insert([
            'name' => 'Permissions',
            'display_name' => 'Permissions',
            'description' => 'Permissions',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $roleId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'name' => 'permissions.index',
            'display_name' => 'Permission Index',
            'description' => 'Permission Index',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'permissions.create',
            'display_name' => 'Permission Create',
            'description' => 'Permission Create',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'permissions.edit',
            'display_name' => 'Permission Edit',
            'description' => 'Permission Edit',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);
    }
}