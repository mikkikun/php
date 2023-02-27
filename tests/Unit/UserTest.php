<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
     /** @test */
    public function return_name_charactor_count(){

        $user = User::factory()->create([
            'name' => 'John'
        ]);

        $result = $user->getNameCount();

        $this->assertEquals(4, $result);
    }
}
