<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        
        $data = [
            [
                'user_id' => '5',
                'post_id' => '15',
                'body' => 'あのカードは次の環境で猛威ふりそうですね',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:12',
                'updated_at' => '2023-02-21 11:11:12',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '15',
                'body' => 'テスト',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '13',
                'body' => '友達になってっくださ！！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '13',
                'body' => '友達になってっくださ！！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '13',
                'body' => '友達になってっくださ！！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '13',
                'body' => '友達になってっくださ！！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '1',
                'post_id' => '13',
                'body' => '友達になってっくださ！！',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:11',
                'updated_at' => '2023-02-21 11:11:11',
                'deleted_at' =>NULL
            ],
            
            
        ];

        DB::table('comments')->insert($data);
    }
}
