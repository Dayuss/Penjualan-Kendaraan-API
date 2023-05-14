<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\vehicleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VehicleService
{
    /**
     * @var $vehicleRepository
     */
    protected $vehicleRepository;

    /**
     * VehicleService constructor.
     *
     * @param Vehicle $vehicleRepository
     */
    public function __construct(vehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }


    /**
     * Get all vehicle.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->vehicleRepository->getAll();
    }

}