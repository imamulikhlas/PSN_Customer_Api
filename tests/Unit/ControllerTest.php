<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\Address;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCustomerCanBeCreated()
    {
        $response = $this->postJson('/customer', [
            'title' => 'Mr',
            'name' => 'Adrien Philippe',
            'gender' => 'M',
            'phone_number' => '085222334445',
            'image' => 'https://img.freepik.com/premium-vector/man-avatar-profile-round-icon_24640-14044.jpg',
            'email' => 'adrien.philipaaaape@gmail.com'
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Customer::all());
    }

    // Add similar tests for other endpoints
}

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAddressCanBeCreated()
    {
        // Create a customer first
        $customer = Customer::factory()->create();

        $response = $this->postJson('/address', [
            'customer_id' => $customer->id,
            'address' => 'Kawasan Karyadeka Pancamurni Blok A Kav. 3',
            'district' => 'Cikarang Selatan',
            'city' => 'Bekasi',
            'province' => 'Jawa Barat',
            'postal_code' => 17530
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, Address::all());
    }

    // Add similar tests for other endpoints
}
