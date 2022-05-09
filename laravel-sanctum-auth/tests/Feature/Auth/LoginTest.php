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
        $user = User::create([
            'name' => "test",
            'email' => "can5@gmail.com",
            'password' => bcrypt($password = 'make12'),
        ]);

        $response = $this->actingAs($user)->post('api/v1/user/login', [
            'email' => $user->email,
            'password' => "make12"//$password
        ]);
        
    
        

        //$response = $this->withHeaders(['Authorization' => "Bearer $token"])
        //    ->json('GET', '/api/v1/user', []);

        $response->assertStatus(200);

        /*$response = $this->post('api/v1/user/login', [
            'email' => "can1@gmail.com",//$user->email,
            'password' => "make12"//$password
        ]);


        $response->assertStatus(200);
        
        $response1 = $this->get('api/v1/user',[
            'Bearer '
        ]);*/
        // cookie assertion goes here
        //$this->assertAuthenticatedAs($user);
    }
}
