<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterTest extends TestCase
{
    /** @test */
    public function ユーザー登録画面のURLにアクセスしてユーザー登録画面が表示される()
    {
        $response = $this->get(route('register'));
        $response->assertViewIs('auth.register');
    }
    
    /** @test */
    public function ユーザー登録に成功した後は投稿一覧画面が表示される()
    {
        // ユーザー登録処理
        $response = $this->post(route('register'), [
            'name' => 'testUser',
            'email' => 'test@example.com',
            'password' => 'registerPass',
            'password_confirmation' => 'registerPass'
        ]);
        $response->assertRedirect(route('top'));
    }
    /** @test */
    public function 名前入力の異常値で登録しようとするとエラーメッセージが表示される()
    {
        $response = $this->post(route('register'), ['name'  => '',]);
        $errorMessage = '名前は必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);

        $response = $this->post(route('register'), ['name'  => Str::random(1),]);
        $errorMessage = '名前は、2文字以上で指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);

        $response = $this->post(route('register'), ['name'  => Str::random(26,100),]);
        $errorMessage = '名前は、25文字以下で指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }
    /** @test */
    public function メールアドレス入力の異常値で登録しようとするとエラーメッセージが表示される()
    {
        $response = $this->post(route('register'), ['email'    => '',]);
        $errorMessage = 'メールアドレスは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);

        // $response = $this->post(route('register'), ['email'  => Str::random(1),]);
        // $errorMessage = 'このメールアドレスは既に存在しています。';
        // $this->get(route('register'))->assertSee($errorMessage);

        // $response = $this->post(route('register'), ['email'  => Str::random(255,1000),]);
        // $errorMessage = 'メールアドレスは、255文字以下で指定してください。';
        // $this->get(route('register'))->assertSee($errorMessage);
    }

    /** @test */
    public function パスワード入力の異常値で登録しようとするとエラーメッセージが表示される()
    {
        $response = $this->post(route('register'), ['password'  => '']);
        $errorMessage = 'パスワードは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);

        $response = $this->post(route('register'), ['password'  => Str::random(1,7)]);
        $errorMessage = 'パスワードは、8文字以上で指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);

        // $response = $this->post(route('register'), ['password,password-confirm'  => Str::random(8)]);
        // $errorMessage = 'パスワードは、8文字以上で指定してください。';
        // $this->get(route('register'))->assertSee($errorMessage);
        
    }
}
