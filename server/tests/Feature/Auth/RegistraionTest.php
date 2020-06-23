<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class RegistraionTest extends TestCase
{
     public function test_it_requires_a_name()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['password']);
    }

    public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_valid_email()
    {
        $this->json('POST', 'api/auth/register', [
            'email' => 'not_email'
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_unique_email()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/register', [
            'email' => $user->email
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_returns_a_user_on_registration()
    {
        $this->json('POST', 'api/auth/register', [
            'email' => $email = 'a@a.com',
            'name' => 'John Doe',
            'password' => 'password',
        ])
            ->assertJsonFragment([
                'email' => $email
            ]);
    }
}
