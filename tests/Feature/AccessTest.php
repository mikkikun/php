<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/password/reset');
        $response->assertStatus(200);

        $response = $this->get('/admin/post/index');
        $response->assertStatus(302);

        $response = $this->get('/admin/post/follow_pose');
        $response->assertStatus(302);

        $response = $this->get('/admin/post/create');
        $response->assertStatus(302);

        $response = $this->get('/admin/post/edit');
        $response->assertStatus(302);

        $response = $this->get('/admin/post/favorite');
        $response->assertStatus(302);

        $response = $this->get('/admin/profile/edit');
        $response->assertStatus(302);

        $response = $this->get('/admin/profile/follow');
        $response->assertStatus(302);

        $response = $this->get('/admin/profile/userpage');
        $response->assertStatus(302);

        $response = $this->get('/admin/comment/edit');
        $response->assertStatus(302);

        $response = $this->get('/admin/comment/favorite');
        $response->assertStatus(302);

        $response = $this->get('/admin/comment/index');
        $response->assertStatus(302);

        $response = $this->get('/admin/chat/chat');
        $response->assertStatus(302);

        $response = $this->get('/admin/chat/list');
        $response->assertStatus(302);
        
    }




}
