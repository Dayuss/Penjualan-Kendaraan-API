<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleTest extends TestCase
{

    use WithFaker;

    public function testCreateVehicleFailed()
    {
        $token = $this->getToken();
        $this->post($this->baseUrl.'/vehicle',[], ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(400)
            ->assertJson([
                "error" => [
                    "vehicle_type"=> ["The vehicle type field is required."], 
                    "engine"=> ["The engine field is required."],
                    "vehicle_year"=> ["The vehicle year field is required."],
                    "color"=> ["The color field is required."],
                    "price"=> ["The price field is required."],
                    "stock"=> ["The stock field is required."]        
                ]
            ]);
    }

    public function testCreateVehicleSuccess()
    {
        $token = $this->getToken();
        $vehicleData = [
            "vehicle_type"=>"car",
            "engine"=>"diesel",
            "capacity"=>"4",
            "type"=>"manual",
            "suspension_type"=>"",
            "transmission_type"=>"",
            "vehicle_year"=>$this->faker()->year(),
            "color"=>$this->faker()->colorName(),
            "price"=>rand(1000,100000),
            "stock"=>rand(10,100)
        ];

        $this->post($this->baseUrl.'/vehicle',$vehicleData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "_id",
                    "vehicle_type",
                    "engine",
                    "capacity",
                    "type",
                    "suspension_type",
                    "transmission_type",
                    "additional_info",
                    "updated_at",
                    "created_at"
                ],
                "status",
                "message"
            ]);
    }

    public function testLsitVehicle()
    {
        $token = $this->getToken();
        $this->get($this->baseUrl.'/vehicle', ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data",
                "status",
                "message"
            ]);
    }

    

}

