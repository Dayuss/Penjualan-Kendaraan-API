<?php

namespace App\Services;

use App\Repositories\SalesRepository;
use App\Repositories\VehicleRepository;

class SalesService
{
    /**
     * @var $vehicle
     */
    protected $vehicle;
    protected $sales;

    /**
     * SalesService constructor.
     *
     * @param SalesService $vehicleRepository
     */
    public function __construct()
    {
        $this->sales = new SalesRepository();
        $this->vehicle = new VehicleRepository();

    }


    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->sales->getAll();
    }

    /**
     * Validate vehicle data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return Boolean
     */
    public function saveSalesData($data)
    {
        // get vehicle data
        $vehicle = $this->vehicle->getById($data['item_id']);
        $data['item']=$vehicle;
        $data['price']=$vehicle->additional_info['price'];
        $data['grand_total']=$vehicle->additional_info['price']*$data['qty'];
        
        // update qty
        $this->vehicle->updateStock($data['qty'],$data['item_id']);

        return $this->sales->save($data);
    }

    

}