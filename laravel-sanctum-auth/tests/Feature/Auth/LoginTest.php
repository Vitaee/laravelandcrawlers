<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = factory(User::class)->create([
            'name' => "test",
            'email' => "can1@gmail.com",
            'password' => bcrypt($password = 'make12'),
        ]);
        
        $response = $this->post('api/v1/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        
        
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }
}
