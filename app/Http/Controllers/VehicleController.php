<?php

namespace App\Http\Controllers;

use App\Services\VehicleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * show all vehicle
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

    /**
     * store a vehicle
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'vehicle_type',
            'engine',
            'capacity',
            'type',
            'suspension_type',
            'transmission_type',
            'vehicle_year',
            'color',
            'price',
            'stock'
        );
        $validator = Validator::make($data, [
            'vehicle_type'=> 'required',
            'engine'=> 'required',
            'vehicle_year'=> 'required',
            'color'=> 'required',
            'price'=> 'required',
            'stock'=> 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $result = ['status' => 200, 'message'=>'success'];

        try {
            $result['data'] = $this->vehicleService->saveVehicleData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'message' =>$e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200, 'message'=>'success'];


        try {
            $result['data'] = $this->vehicleService->deleteById($id);
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