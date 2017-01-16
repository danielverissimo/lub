<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

// composer require laracasts/testdummy

class TesteTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Tweet');

        DB::table('roles')->insert([
            'name' => 'Users',
            'display_name' => 'Users',
            'description' => 'Users',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $roleId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'name' => 'users.index',
            'display_name' => 'User Index',
            'description' => 'User Index',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.create',
            'display_name' => 'User Create',
            'description' => 'User Create',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.edit',
            'display_name' => 'User Edit',
            'description' => 'User Edit',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);
    }
}