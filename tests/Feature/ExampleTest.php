<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**@test */
    public function only_logged_in_users_can_see_the_customers_list()
    {
        $response = $this->get('/customers')->assertRedirect('/login');
    } 
}
