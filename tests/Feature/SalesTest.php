<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{

    use WithFaker;

    public function testCreateSalesFailed()
    {
        $token = $this->getToken();
        $this->post($this->baseUrl.'/sales',[], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(400)
            ->assertJson([
                "error" => [
                    "qty"=> ["The qty field is required."], 
                    "item_id"=> ["The item id field is required."],
                ]
            ]);
    }

    public function testCreateVehicleSuccess()
    {
        $token = $this->getToken();
        $vehicleID = $this->getVehicleID();
        
        $vehicleData = [
            "item_id"=>$vehicleID,
            "qty"=>rand(10,50)
        ];

        $this->post($this->baseUrl.'/sales',$vehicleData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data",
                "status",
                "message"
            ]);
    }

    public function testLsitVehicle()
    {
        $token = $this->getToken();
        $this->get($this->baseUrl.'/sales', ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data",
                "status",
                "message"
            ]);
    }

}

