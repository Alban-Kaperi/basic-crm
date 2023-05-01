<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_customer()
    {
        $customerData = [
            'name' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'place' => $this->faker->city,
            'telephone' => '6589-35-85',
            'email' => $this->faker->email,
        ];

        $response = $this->json('POST', route('customers.store'), $customerData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'name', 'address', 'postal_code', 'place', 'telephone', 'email', 'created_at', 'updated_at'
            ])
            ->assertJsonFragment($customerData);
    }

    public function test_can_show_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->json('GET', route('customers.show', $customer->id));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id', 'name', 'address', 'postal_code', 'place', 'telephone', 'email', 'created_at', 'updated_at'
            ])
            ->assertJsonFragment($customer->toArray());
    }

    public function test_can_update_customer()
    {
        $customer = Customer::factory()->create();

        $updatedData = [
            'name' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'place' => $this->faker->city,
            'telephone' => '6589-35-85',
            'email' => $this->faker->email,
        ];

        $response = $this->json('PUT', route('customers.update', $customer->id), $updatedData);

        // Check if the response status is 200 and the content is true
        $response->assertStatus(200);

        // Check if the customer data was updated in the database
        $this->assertDatabaseHas('customers', $updatedData);
    }

    public function test_can_delete_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->json('DELETE', route('customers.destroy', $customer->id));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
