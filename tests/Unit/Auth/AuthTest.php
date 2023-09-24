<?php

namespace Tests\Unit\Auth;

use Tests\TestCase;
use Faker\Factory;
use Faker\Generator;
use function PHPUnit\Framework\isEmpty;

class AuthTest extends TestCase
{
    public $jwt_token;
    private Generator $faker;
    /**
     * A basic unit test login api.
     */

     public function setUp(): void {
     
         parent::setUp();
         $this->faker = Factory::create();
     }

    public function test_the_application_returns_a_successful_response_login(): void
    {
        $response = $this->post('http://127.0.0.1:8000/api/login', [
            'email' => 'gurukiran0809@gmail.com',
            'password' => 'guru1234'
        ]);
        $this->jwt_token = $response['authorisation']['token'];
        $response->assertStatus(200);
    }

    /**
     * A basic unit test user details api.
     */
    public function test_the_application_returns_a_successful_response_user_details(): void
    {
        if (isEmpty($this->jwt_token)) {
            $this->test_the_application_returns_a_successful_response_login();
        } else {
            $response = $this->withHeaders([
                'Bearer Token' => $this->jwt_token,
            ])->post('http://127.0.0.1:8000/api/user_details');

            $response->assertStatus(200);
        }
    }

    /**
     * A basic unit test refresh token api.
     */
    public function test_the_application_returns_a_successful_response_refresh_token(): void
    {
        if (isEmpty($this->jwt_token)) {
            $this->test_the_application_returns_a_successful_response_login();
        } else {
            $response = $this->withHeaders([
                'Bearer Token' => $this->jwt_token,
            ])->post('http://127.0.0.1:8000/api/refresh');

            $response->assertStatus(200);
        }
    }

    /**
     * A basic unit test logout api.
     */
    public function test_the_application_returns_a_successful_response_refresh_logout(): void
    {
        if (isEmpty($this->jwt_token)) {
            $this->test_the_application_returns_a_successful_response_login();
        } else {
            $response = $this->withHeaders([
                'Bearer Token' => $this->jwt_token,
            ])->post('http://127.0.0.1:8000/api/logout');

            $response->assertStatus(200);
        }
    }

    /**
     * A basic unit test registration api.
     */
    public function test_the_application_returns_a_successful_response_registration():void
    {   
        
        $response = $this->post('http://127.0.0.1:8000/api/register',[
           'name' => $this->faker->firstName,
           'email' => $this->faker->unique()->email,
           'password' => $this->faker->password(6,8),
        ]);

        $response->assertStatus(200);
    }
}
