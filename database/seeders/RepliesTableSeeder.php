<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('replies')->delete();

        
        $data = [
            [
                'user_id' => '2',
                'comment_id' => '1',
                'body' => 'ぶっ壊れですね',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:15',
                'updated_at' => '2023-02-21 11:11:15',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '5',
                'comment_id' => '1',
                'body' => 'どうなるか楽しみです',
                'image_path' => NULL,
                'created_at' => '2023-02-21 11:11:16',
                'updated_at' => '2023-02-21 11:11:16',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '3',
                'comment_id' => '3',
                'body' => 'メッセージ待ってます',
                'image_path' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/replie/Dptx1mHUUAIFijk.jpeg',
                'created_at' => '2023-02-21 11:11:16',
                'updated_at' => '2023-02-21 11:11:16',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '3',
                'comment_id' => '4',
                'body' => 'メッセージ待ってます',
                'image_path' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/replie/Dptx1XcVsAIp7eD.jpeg',
                'created_at' => '2023-02-21 11:11:16',
                'updated_at' => '2023-02-21 11:11:16',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '3',
                'comment_id' => '5',
                'body' => 'メッセージ待ってます',
                'image_path' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/replie/Dptx2FfUUAIq9BO.jpeg',
                'created_at' => '2023-02-21 11:11:17',
                'updated_at' => '2023-02-21 11:11:17',
                'deleted_at' =>NULL
            ],
            [
                'user_id' => '3',
                'comment_id' => '3',
                'body' => 'メッセージ待ってます',
                'image_path' => 'https://cardmatch-s3.s3.ap-northeast-1.amazonaws.com/replie/Dptx11OV4AE6RRm.jpeg',
                'created_at' => '2023-02-21 11:11:18',
                'updated_at' => '2023-02-21 11:11:18',
                'deleted_at' =>NULL
            ],
            
            
            
        ];

        DB::table('replies')->insert($data);
    }
}
