<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class LoginTest extends TestCase
{
    /** @test */
    public function ログイン画面のURLにアクセスして画面が表示される()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /** @test */
    public function ログイン画面のURLにアクセスしてログイン画面が表示される()
    {
        $response = $this->get(route('login'));
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function 登録しておいたemailアドレスとパスワードでログインできる()
    {
        $user = User::factory()->create([
            'email' => 'pass1@example.com',
            'password'  => bcrypt('loginPass')
        ]);
        $response = $this->post(route('login'), [
            'email'    => 'pass1@example.com',
            'password'  => 'loginPass'
        ]);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function ログインに成功した後は投稿一覧画面が表示される()
    {
        $user = User::factory()->create([
            'email' => 'pass2@example.com',
            'password'  => bcrypt('loginPass')
        ]);
        // ログイン処理
        $response = $this->post(route('login'), [
            'email'    => 'pass2@example.com',
            'password'  => 'loginPass'
        ]);
        $response->assertRedirect(route('top'));
    }

    /** @test */
    public function 登録したのと違うメールアドレスでログインしようとしてもログインできない()
    {
        $user = User::factory()->create([
            'email' => 'pass3@example.com',
            'password'  => bcrypt('loginPass')
        ]);
        // ログイン処理
        $response = $this->post(route('login'), [
            'email'    => 'pass3@exae.com',
            'password'  => 'loginPass'
        ]);
        $this->assertGuest();
    }

    /** @test */
    public function 登録したのと違うパスワードでログインしようとしてもログインできない()
    {
        $user = User::factory()->create([
            'email' => 'pass4@example.com',
            'password'  => bcrypt('loginpass')
        ]);
        // ログイン処理
        $response = $this->post(route('login'), [
            'email'    => 'pass4@example.com',
            'password'  => 'liginpass'
        ]);
        $this->assertGuest();
    }

    /** @test */
    public function 異なるアドレスでログインしようとするとエラーメッセージが表示される()
    {
        $user = User::factory()->create([
            'email' => 'pass5@example.com',
            'password'  => bcrypt('loginPass')
        ]);
        $response = $this->post(route('login'), [
            'email'    => 'pass5@exae.com',
            'password'  => 'loginPass'
        ]);
        $errorMessage = 'ログインできません。入力した情報に誤りがないかご確認ください。';
        $this->get(route('login'))->assertSee($errorMessage);
    }

    /** @test */
    public function 異なるパスワードでログインしようとするとエラーメッセージが表示される()
    {
        $user = User::factory()->create([
            'email' => 'pass6@example.com',
            'password'  => bcrypt('loginpass')
        ]);
        $response = $this->post(route('login'), [
            'email'    => 'pass6@example.com',
            'password'  => 'lss'
        ]);
        $errorMessage = 'ログインできません。入力した情報に誤りがないかご確認ください。';
        $this->get(route('login'))->assertSee($errorMessage);
    }

    /** @test */
    public function ログアウトすると認証状態が解除される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // ログアウトリクエスト
        $response = $this->post(route('logout'));
        // ユーザーが認証されていない
        $this->assertGuest();
    }
}
