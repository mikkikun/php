<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
  
        
    public function definition()
    {
        // $random_id = optional(User::inRandomOrder()->first())->id;
        // $id = $faker->bool && $random_id ? $random_id : factory(User::class)->create()->id
        // $cardgames = ["遊戯王", "遊戯王ラッシュデュエル", "デュエル・マスターズ", "ポケモンカード", "ヴァイスシュヴァルツ", "シャドウバース", "ヴァンガード", "ONE PIECE", "マジック・ザ・ギャザリング", "ウィクロス", "その他"];
        // $cardgame = $cardgames[rand(0, count($cardgames) - 1)];
        return [
            'user_id' => Str::random(10),
            'title' => $this->faker->comment(25),
            'body' => $this->faker->comment(255),
            // 'cardgame' => $cardgame, 
            'image_path' =>  NULL,
        ];
    }
}
