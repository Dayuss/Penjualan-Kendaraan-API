<?php

namespace App\Services;

use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class VehicleService
{
    /**
     * @var $vehicle
     */
    protected $vehicle;

    /**
     * VehicleService constructor.
     *
     * @param Vehicle $vehicleRepository
     */
    public function __construct()
    {
        $this->vehicle = new Vehicle();
    }


    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->vehicle::all();
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
        $this->vehicle->vehicle_type = $data['vehicle_type'];
        $this->vehicle->engine = $data['engine'];
        $this->vehicle->capacity = $data['capacity'];
        $this->vehicle->type = $data['type'];
        $this->vehicle->suspension_type = $data['suspension_type'];
        $this->vehicle->transmission_type = $data['transmission_type'];
        $this->vehicle->additional_info = array(
            "vehicle_year"=>$data['vehicle_year'],
            "color"=>$data['color'],
            "price"=>$data['price'],
            "stock"=>$data['stock'],
        );
        // additional_info
        return $this->vehicle->save();
    }

    
    /**
     * Delete vehicle by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $vehicle = $this->vehicle->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete vehicle data');
        }

        DB::commit();

        return $vehicle;

    }

}