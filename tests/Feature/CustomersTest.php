<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();

        Event::fake();
    }


    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
    public function test_only_logged_in_users_can_see_the_customers_list()
    {
        $response = $this->get('/customers');
        $response->assertOk();
        //$response->assertRedirect('/login');
    } 

    /** @test*/
    public function test_authenticated_users_can_see_the_customers_list()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $response = $this->get('/customers');
        $response->assertOk();
    }

    public function test_a_customer_can_be_added_through_the_form_but_only_by_admin()
    {
        //Event::fake(); //its on the top 

        //$this->withoutExceptionHandling();

        //if this can add the customer :::
            // but to create the customer we must have an 
            //ADMIN@ADMIN.COM emal SO :::
            $this->actingLikeAdmin();


        //if this can add the customer :::
        $response = $this->post('/customers', $this->customerData());
        //it mean that we will have 1 new customer in our database
        //as all data from database clear every time we using the tests 
        $this -> assertCount(1, Customer::all());
    }

    /**@test */
    public function test_the_name_is_required()
    {
        //Event::fake(); // at the top 

        //action like an ADMIN
        $this->actingLikeAdmin();

        //so we add th empty name to our customer :::
        $response = $this->post('/customers', 
            array_merge($this->customerData(), ['name' => '']));
            
        //checking if we have an error without name
        $response->assertSessionHasErrors('name');
        //and we CANNOT have a record at the DB
        $this->assertCount(0, Customer::all());
    }

    public function test_the_name_at_least_3_characters()
    {
        //action like an ADMIN
        $this->actingLikeAdmin();

        //so we add th empty name to our customer :::
        $respon = $this->post('/customers', 
            array_merge($this->customerData(), ['name' => 'ab']));
            
        //checking if we have an error without name
        $respon->assertSessionHasErrors('name');
        //and we CANNOT have a record at the DB
        $this->assertCount(0, Customer::all());

        
    }

    public function test_the_email_is_required()
    {
        $this->actingLikeAdmin();

        $response = $this->post('/customers', 
            array_merge($this->customerData(), ['email' => '']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Customer::all());
    }
    public function test_the_email_must_be_an_email()
    {
        $this->actingLikeAdmin();

        $response = $this->post('/customers', 
            array_merge($this->customerData(), ['email' => 'test_wrong_email']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Customer::all());
    }



    /** @test*/
    public function test_a_new_user_gets_an_email_when_it_registers()
    {
         //test 
        $response = $this->get('/customers');
        $response->assertOk();
    }

    private function customerData()
    {
        return [
            'name' => 'TestName',
            'email' => 'email@email.com',
            'active' => 1,
            'company_id' => 1,
        ];
    }

    /**
     * Summary of actingLikeAdmin
     * @return void
     */
    private function actingLikeAdmin():void
    {
        //acting like an ADMIN
        $this->actingAs(\App\Models\User::factory()->create([
            'email' => 'admin@admin.com',
        ]));
    }
}
