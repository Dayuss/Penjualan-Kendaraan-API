<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $baseUrl = 'http://localhos:8000/api'; // tambah $baseUrl

    public function getToken() {
        $userData = [
            "name" => $this->faker()->name(),
            "email" => $this->faker()->email(),
            "password" => $this->faker()->password(),
        ];
        $this->post($this->baseUrl.'/register', $userData, ['Accept' => 'application/json']);

        $loginData = [
            "email" => $userData['email'],
            "password" => $userData['password']
        ];

        $response=$this->post($this->baseUrl.'/login', $loginData, ['Accept' => 'application/json']);
        $token = $response->json('data')['token'];

        return $token;

    }
    public function getVehicleID()
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

        $response = $this->post($this->baseUrl.'/vehicle',$vehicleData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token]);
        return $response->json('data')['_id'];
    }
}
