<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class TweetTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Tweet');

        DB::table('roles')->insert([
            'name' => 'Tweets',
            'display_name' => 'Tweets',
            'description' => 'Tweets',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $roleId = DB::getPdo()->lastInsertId();

        DB::table('permissions')->insert([
            'name' => 'tweets.index',
            'display_name' => 'Tweet Index',
            'description' => 'Tweet Index',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'tweets.create',
            'display_name' => 'Tweet Create',
            'description' => 'Tweet Create',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);

        DB::table('permissions')->insert([
            'name' => 'tweets.edit',
            'display_name' => 'Tweet Edit',
            'description' => 'Tweet Edit',
            'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $permissionId = DB::getPdo()->lastInsertId();

        DB::table('permission_role')->insert([
            'permission_id' => $permissionId,
            'role_id' => $roleId
        ]);
    }
}