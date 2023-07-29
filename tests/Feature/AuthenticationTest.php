<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    use WithFaker;

    public function testRequiredFieldsForRegistration()
    {
        $this->post($this->baseUrl.'/register',[], ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                "status" => 400,
                "message" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testRegiterSuccess()
    {
        $userData = [
            "name" => $this->faker()->name(),
            "email" => $this->faker()->email(),
            "password" => $this->faker()->password(),
        ];
        $this->post($this->baseUrl.'/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    '_id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "status",
                "message"
            ]);
    }

    public function testLoginSuccess()
    {
        $userData = [
            "name" => $this->faker()->name(),
            "email" => $this->faker()->email(),
            "password" => $this->faker()->password(),
        ];
        $this->post($this->baseUrl.'/register', $userData, ['Accept' => 'application/json']);

        $loginData = [
            "email" => $userData['email'],
            "password" => $userData['password']
        ];

        $this->post($this->baseUrl.'/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    'token',
                ],
                "status",
                "message"
            ]);
    }

    public function testLoginUnRegistered()
    {
        $loginData = [
            "email" => "iniemail@gmail.com",
            "password" => "123321"
        ];

        $this->post($this->baseUrl.'/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(400)
             ->assertJson([
                "status"=> 400,
                "message"=> "User not registered."
            ]);
    }
}

