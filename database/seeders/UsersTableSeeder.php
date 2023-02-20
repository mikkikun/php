<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = [
            [
                'name' => 'ユーザー１',
                'email' => 'user1@test.com',
                'password' => Hash::make('password'),
                'profile' => 'こんにちは',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ]
        ];

        DB::table('users')->insert($data);
    }
}
