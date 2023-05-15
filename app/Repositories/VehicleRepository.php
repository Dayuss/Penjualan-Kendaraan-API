<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
    /**
     * @var Vehicle
     */
    protected $vehicle;

    /**
     * VehicleRepository constructor.
     *
     * @param Vehicle $vehicle
     */
    public function __construct()
    {
        $this->vehicle = new Vehicle();
    }

    /**
     * Get all vehicles.
     *
     * @return Vehicle $vehicle
     */
    public function getAll()
    {
        return $this->vehicle
            ->get();
    }

    /**
     * Get Vehicle by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return ($this->vehicle
            ->where('_id', $id)
            ->get())[0];
    }

    /**
     * Save Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function save($data)
    {
        $vehicle = new $this->vehicle;

        $vehicle->vehicle_type = $data['vehicle_type'];
        $vehicle->engine = $data['engine'];
        $vehicle->capacity = $data['capacity'];
        $vehicle->type = $data['type'];
        $vehicle->suspension_type = $data['suspension_type'];
        $vehicle->transmission_type = $data['transmission_type'];
        $vehicle->additional_info = array(
            "vehicle_year"=>$data['vehicle_year'],
            "color"=>$data['color'],
            "price"=>$data['price'],
            "stock"=>$data['stock'],
        );
        // additional_info
        $vehicle->save();

        return $vehicle->fresh();
    }

    /**
     * Update Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function updateStock($stock, $id)
    {
        $vehicle = $this->vehicle->find($id);
        $vehicle->additional_info = array(
            "stock"=>$vehicle->additional_info['stock'] - $stock,
            "vehicle_year"=>$vehicle->additional_info['vehicle_year'],
            "color"=>$vehicle->additional_info['color'],
            "price"=>$vehicle->additional_info['price']
        );
        $vehicle->update();
        return $vehicle;
    }

    /**
     * Update vehicle
     *
     * @param $data
     * @return vehicle
     */
    public function delete($id)
    {
        
        $vehicle = $this->vehicle->find($id);
        $vehicle->delete();

        return $vehicle;
    }

}