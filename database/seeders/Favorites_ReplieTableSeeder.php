<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Favorites_ReplieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites_replie')->delete();

        
        $data = [
            [
                'user_id' => '1',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '4',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '5',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '6',
                'replie_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '1',
                'replie_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'replie_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '4',
                'replie_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '5',
                'replie_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '1',
                'replie_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('favorites_replie')->insert($data);
    }
}
