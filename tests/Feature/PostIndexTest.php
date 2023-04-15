<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostIndexTest extends TestCase
{
    /** @test */
    public function 投稿一覧のURLにアクセスして画面が表示される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('top'));
        $response->assertStatus(200);
    }

    /** @test */
    public function 投稿一覧のURLにアクセスして投稿一覧画面が表示される()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('top'));
        $response->assertViewIs('admin.post.index');
    }

    /** @test */
    public function ログインしていない場合は投稿一覧のURLにアクセスしてもログイン画面が表示される()
    {
        $response = $this->get(route('top'));
        $response->assertRedirect(route('login'));
    }


}
