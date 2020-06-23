<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends TestCase
{
       public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['email']);
    }
    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['password']);
    }


    public function test_it_return_validation_error_if_credentials_dont_match()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'nope'
        ])
            ->assertJsonValidationErrors(['email']);
    }

     public function test_it_return_token_if_credentials_match()
    {
        $user = factory(User::class)->create([
            'password' =>  'cats'
        ]);

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' =>  'cats'
        ])
            ->assertJsonStructure([
                'meta' => [
                    'token'
                ]
            ]);
    }

    public function test_it_returns_a_user_if_credentials_match()
    {
       $user = factory(User::class)->create([
            'password' =>  'cats'
        ]);

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' =>  'cats'
        ])
            ->assertJsonFragment([
                'email' => $user->email
            ]);
    }
}
