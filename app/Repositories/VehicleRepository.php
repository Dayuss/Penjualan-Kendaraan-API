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
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
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
        return $this->vehicle
            ->where('id', $id)
            ->get();
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

        $vehicle->title = $data['title'];
        $vehicle->description = $data['description'];

        $vehicle->save();

        return $vehicle->fresh();
    }

    /**
     * Update Vehicle
     *
     * @param $data
     * @return Vehicle
     */
    public function update($data, $id)
    {
        
        $vehicle = $this->vehicle->find($id);

        $vehicle->title = $data['title'];
        $vehicle->description = $data['description'];

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