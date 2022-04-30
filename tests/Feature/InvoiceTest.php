<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class InvoiceTest extends TestCase
{

    public function test_invoice_index()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin,'api')->get('/api/invoice');


        $response->assertStatus(200);
    }

    public function test_stores_invoice()
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin,'api')->post('/api/invoice',[
            'full_name'=>"Muahammed Ibarhem",
            'mobile'=>"0120526548",
            "email"=>"muhammed86@gmail.com",
            "amount"=>500,
            "due_date"=>"2022/5/2"
        ]);

               
        $response->assertStatus(201);
    }

 
}
