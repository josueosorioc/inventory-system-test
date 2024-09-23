<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Valida si el usuario puede iniciar sesión correctamente
     */
    public function test_user_can_login(): void
    {
        $credentials = [
            'email' => 'josue.osorio@example.com',
            'password' => 'abc.123'
        ];

        $response = $this->post('validate-login', $credentials);

        $response->assertRedirect('/articulos');

        $this->get('/articulos')->assertStatus(200);
    }

    /**
     * Valida si el usuario puede registrarse correctamente
     */
    public function test_user_can_sign_up(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'abc.123'
        ];

        $response = $this->post('register-save', $userData);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);

        $response->assertRedirect('/articulos');

        $this->get('/articulos')->assertStatus(200);
    }
}
