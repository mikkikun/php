<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followers')->delete();

        
        $data = [
            [
                'following_id' => '1',
                'followed_id' => '2',
            ],
            [
                'following_id' => '2',
                'followed_id' => '1',
            ],
            [
                'following_id' => '1',
                'followed_id' => '3',
            ],
            [
                'following_id' => '3',
                'followed_id' => '1',
            ],
            [
                'following_id' => '1',
                'followed_id' => '4',
            ],
            [
                'following_id' => '4',
                'followed_id' => '1',
            ],
            [
                'following_id' => '1',
                'followed_id' => '5',
            ],
            [
                'following_id' => '5',
                'followed_id' => '1',
            ],
            [
                'following_id' => '1',
                'followed_id' => '6',
            ],
            [
                'following_id' => '6',
                'followed_id' => '1',
            ],
            [
                'following_id' => '2',
                'followed_id' => '3',
            ],
            [
                'following_id' => '3',
                'followed_id' => '2',
            ],
            [
                'following_id' => '2',
                'followed_id' => '4',
            ],
            [
                'following_id' => '4',
                'followed_id' => '2',
            ],
            [
                'following_id' => '2',
                'followed_id' => '5',
            ],
            [
                'following_id' => '5',
                'followed_id' => '2',
            ],
            [
                'following_id' => '2',
                'followed_id' => '6',
            ],
            [
                'following_id' => '6',
                'followed_id' => '2',
            ],
            [
                'following_id' => '4',
                'followed_id' => '3',
            ],
            
        ];

        DB::table('followers')->insert($data);
    }
}
