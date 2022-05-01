<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Client;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_database()
    {
        $this->assertDatabaseHas('users',[
            'name'=>'admin'
        ]);
    }

    public function test_login()
    {
        $response = $this->post('/api/login',[
            'email'=>"admin@admin.com",
            'password'=>"123456",
        ]);


        $response->assertStatus(200);
    }

    public function test_client_index()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin,'api')->get('/api/client');


        $response->assertStatus(200);
    }

    public function test_stores_client()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin,'api')->post('/api/client',[
            'full_name'=>"Muahammed Ibarhem",
            'mobile'=>"0120526548",
            "email"=>"muhammed86@gmail.com"
        ]);

               
        $response->assertStatus(201);
    }

    public function test_email_validation()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin,'api')->post('/api/client',[
            'full_name'=>"Muahammed Ibarhem",
            'mobile'=>"0120526548",
            "email"=>"muhammed86@gmail.com"
        ]);

               
        $response->assertStatus(302);
    }

    public function test_updates_client()
    {
        $admin = User::factory()->create();

        $client = Client::factory()->create(['full_name' => 'Peter Mask']);

        $response = $this->actingAs($admin,'api')->put("/api/client/{$client->id}",[
            'full_name'=>"Poala Andrew",
            'mobile'=>"0120526548",
            'email'=>$client->email
        ]);

               
        $response->assertStatus(201);
    }

    public function test_if_seeder_works()
    {
        $this->seed();
    }
}
