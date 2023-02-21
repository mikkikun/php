<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Favorites_CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites_comments')->delete();

        
        $data = [
            [
                'user_id' => '1',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '4',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '5',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '6',
                'comment_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '1',
                'comment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'comment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '4',
                'comment_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '5',
                'comment_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '1',
                'comment_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        DB::table('favorites_comments')->insert($data);
    }
}
