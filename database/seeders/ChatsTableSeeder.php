<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->delete();

        
        $data = [
            [
                'my_id' => '1',
                'user_id' => '2',
                'comment' => 'こんにちは',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:12',
                'updated_at' => '2023-02-21 11:11:12',
            ],
            [
                'my_id' => '2',
                'user_id' => '1',
                'comment' => 'こんにちは！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:22',
                'updated_at' => '2023-02-21 11:11:22',
            ],
            [
                'my_id' => '2',
                'user_id' => '1',
                'comment' => '友達になりましょう',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:32',
                'updated_at' => '2023-02-21 11:11:32',
            ],
            [
                'my_id' => '1',
                'user_id' => '2',
                'comment' => '嬉しいです',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:12:12',
                'updated_at' => '2023-02-21 11:12:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '2',
                'comment' => '仲良くなりたいです',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:14:12',
                'updated_at' => '2023-02-21 11:14:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '2',
                'comment' => '対戦したいですね',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:12',
                'updated_at' => '2023-02-21 12:11:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '2',
                'comment' => 'テスト',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:22',
                'updated_at' => '2023-02-21 12:11:22',
            ],
            [
                'my_id' => '1',
                'user_id' => '3',
                'comment' => 'こんにちは',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:12',
                'updated_at' => '2023-02-21 11:11:12',
            ],
            [
                'my_id' => '3',
                'user_id' => '1',
                'comment' => 'こんにちは！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:22',
                'updated_at' => '2023-02-21 11:11:22',
            ],
            [
                'my_id' => '3',
                'user_id' => '1',
                'comment' => '友達になりましょう',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:32',
                'updated_at' => '2023-02-21 11:11:32',
            ],
            [
                'my_id' => '1',
                'user_id' => '3',
                'comment' => '嬉しいです',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:12:12',
                'updated_at' => '2023-02-21 11:12:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '3',
                'comment' => '仲良くなりたいです',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:14:12',
                'updated_at' => '2023-02-21 11:14:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '3',
                'comment' => '対戦したいですね',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:12',
                'updated_at' => '2023-02-21 12:11:12',
            ],
            [
                'my_id' => '1',
                'user_id' => '3',
                'comment' => 'テスト',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:22',
                'updated_at' => '2023-02-21 12:11:22',
            ],
            [
                'my_id' => '1',
                'user_id' => '4',
                'comment' => 'テスト',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:22',
                'updated_at' => '2023-02-21 12:11:22',
            ],
            [
                'my_id' => '5',
                'user_id' => '1',
                'comment' => 'テスト',
                'image_path' => NULL,
                'created_at' => '2023-02-21 12:11:22',
                'updated_at' => '2023-02-21 12:11:22',
            ],
            
            
        ];

        DB::table('chats')->insert($data);
    }
}
