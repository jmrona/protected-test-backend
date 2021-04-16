<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthManagmentTest extends TestCase
{
    public function test_can_login()
    {
        // $this->withoutExceptionHandling();
        // $userAuth = User::factory([
        //     'canSignIn' => true
        // ])->create();

        // $payload = [
        //     'userName' => $userAuth->userName,
        //     'password' => $userAuth->password,
        // ];

        // $response = $this->post('/api/login',$payload);
        // $response->assertStatus(200);
    }

    public function test_cannot_login()
    {
        // $this->withoutExceptionHandling();
        // $userAuth = User::factory([
        //     'canSignIn' => false
        // ])->create();

        // $payload = [
        //     'userName' => '',
        //     'password' => '',
        // ];

        // $response = $this->post('/api/login',$payload);
        // $response->assertOk()->assertStatus(400);
    }

    public function test_register_sucessfully()
    {
        // $this->withoutExceptionHandling();

        // $payload = [
        //     'firstName' => 'test',
        //     'lastName' => 'test',
        //     'userName' => 'test',
        //     'password' => 'test123',
        // ];

        // $response = $this->post('/api/register',$payload);
        // $response->assertStatus(200);
    }

    public function test_register_failed()
    {
        // $this->withoutExceptionHandling();

        // $payload = [
        //     'firstName' => '',
        //     'lastName' => '',
        //     'userName' => '',
        //     'password' => '',
        // ];

        // $response = $this->post('/api/register',$payload);
        // $response->assertStatus(400);
    }
}
