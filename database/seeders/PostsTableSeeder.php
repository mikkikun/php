<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        
        $data = [
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-20 00:01:20',
                'updated_at' => '2022-02-20 00:01:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-20 00:02:20',
                'updated_at' => '2022-02-20 00:02:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-20 00:03:20',
                'updated_at' => '2022-02-20 00:03:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-20 00:04:20',
                'updated_at' => '2022-02-20 00:04:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-20 00:05:20',
                'updated_at' => '2022-02-20 00:05:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-21 00:00:20',
                'updated_at' => '2022-02-21 00:00:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-21 00:01:20',
                'updated_at' => '2022-02-21 00:01:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-21 00:02:20',
                'updated_at' => '2022-02-21 00:02:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-21 01:00:20',
                'updated_at' => '2022-02-21 01:00:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-21 02:00:20',
                'updated_at' => '2022-02-21 02:00:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'title' => 'テストデータ',
                'body' => 'テスト',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2022-02-25 00:04:20',
                'updated_at' => '2022-02-25 00:04:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '2',
                'title' => 'カードゲーム',
                'body' => '最近遊戯王を復帰しました。一緒にやりましょう',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2023-02-20 00:44:20',
                'updated_at' => '2023-02-20 00:44:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '3',
                'title' => 'ポケカ勢と繋がりたい',
                'body' => '友達募集！！',
                'cardgame' => 'ポケモンカード',
                'image_path' => 'PCG_wallpaper_room_day.jpg',
                'created_at' => '2023-02-21 00:44:20',
                'updated_at' => '2023-02-21 00:44:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '4',
                'title' => '構築論',
                'body' => 'ビートダウンかジャンクで迷う。',
                'cardgame' => 'マジック・ザ・ギャザリング',
                'image_path' => NULL,
                'created_at' => '2023-02-21 01:44:20',
                'updated_at' => '2023-02-21 01:44:20',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '2',
                'title' => '新弾情報',
                'body' => '新弾のカード強い！！',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => '2023-02-21 10:44:20',
                'updated_at' => '2023-02-21 10:44:20',
                'deleted_at' =>NULL
            ],
            
        ];

        DB::table('posts')->insert($data);
    }
}
