<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserManagmentTest extends TestCase
{
    /**
     *
     * @test
     */
    public function test_getUsers(){
        // $users = User::all();

        // $userAuth = Sanctum::actingAs(User::factory([
        //     'canSignIn' => true
        // ])->create());

        // $response = $userAuth->get('/home');

        // $response->assertStatus(200);
    }
}
