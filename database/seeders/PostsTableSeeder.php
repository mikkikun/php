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
                'user_id' => '2',
                'title' => 'カードゲーム',
                'body' => '最近遊戯王を復帰しました。一緒にやりましょう',
                'cardgame' => '遊戯王',
                'image_path' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' =>NULL
            ],
            
        ];

        DB::table('posts')->insert($data);
    }
}
