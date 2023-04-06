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
                'name' => 'テストユーザー',
                'email' => 'user1@test.com',
                'password' => Hash::make('password'),
                'profile' => 'よろしく',
                'profile_image' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => '決闘者',
                'email' => 'user2@test.com',
                'password' => Hash::make('password'),
                'profile' => 'こんにちは。東京に住んでいます。一緒に遊戯王できる人を探しています。メッセージください。',
                'profile_image' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/profile_image/publicdomainq-0013784tqc.jpg 00-00-18-272.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => 'ポケモン大好き',
                'email' => 'user3@test.com',
                'password' => Hash::make('password'),
                'profile' => 'こんにちは。東京に住んでいます。ポケカ歴1年。大会によく出てます。',
                'profile_image' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/profile_image/2303.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => '一般人',
                'email' => 'user4@test.com',
                'password' => Hash::make('password'),
                'profile' => '最近、昔ハマっていたマジックギャザリングをしています。プレイ仲間募集！！',
                'profile_image' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/profile_image/back_image.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => 'なつ',
                'email' => 'user5@test.com',
                'password' => Hash::make('password'),
                'profile' => '遊戯王。一緒に大会でれる人、探してる',
                'profile_image' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => 'ユーザー6',
                'email' => 'user6@test.com',
                'password' => Hash::make('password'),
                'profile' => '見る専',
                'profile_image' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            [
                'name' => 'ユーザー7',
                'email' => 'user7@test.com',
                'password' => Hash::make('password'),
                'profile' => '無',
                'profile_image' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            
        ];

        DB::table('users')->insert($data);
    }
}
