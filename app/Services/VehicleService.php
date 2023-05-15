<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
class VehicleService
{
    /**
     * @var $vehicle
     */
    protected $vehicle;

    /**
     * VehicleService constructor.
     *
     * @param VehicleRepository $vehicleRepository
     */
    public function __construct()
    {
        $this->vehicle = new VehicleRepository();
    }


    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->vehicle->getAll();
    }

    /**
     * Get vehicle by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->vehicle->getById($id);
    }

    /**
     * Validate vehicle data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Boolean
     */
    public function saveVehicleData($data)
    {
        return $this->vehicle->save($data);
    }
}