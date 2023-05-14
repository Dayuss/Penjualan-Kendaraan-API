<?php

namespace App\Http\Controllers;

use App\Services\VehicleService;
use Exception;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    protected $vehicleService;

    /**
     * VehicleController Constructor
     *
     * @param VehicleService $vehicleService
     *
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200, 'message'=>'success'];


        try {
            $result['data'] = $this->vehicleService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'message' => 'failed',
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}