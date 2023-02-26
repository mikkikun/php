<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $users = factory(User::class)->create([
            'password'  => bcrypt('laraveltest123')
            //パスワードは好きな言葉で大丈夫です
        ]);

        // 認証されないことを確認
        $this->assertFalse(Auth::check());

        // ログインを実行
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'laraveltest123'
            //先ほど設定したパスワードを入力
        ]);

        // 認証されていることを確認
        $this->assertTrue(Auth::check());
        // ログイン後にホームページにリダイレクトされるのを確認
        $response->assertRedirect('home');
        //作成したサイトでログイン後にリダイレクトされるルート情報を記述
    }
}
