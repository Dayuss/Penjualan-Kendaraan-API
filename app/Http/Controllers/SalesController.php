<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SalesController extends Controller
{
    /**
     * @var SalesService
     */
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    /**
     * show all sales
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200, 'message'=>'success'];

        try {
            $result['data'] = $this->salesService->getAll();
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
     * store a sales
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'qty',
            'item_id',
        );
        $validator = Validator::make($data, [
            'qty'=> 'required',
            'item_id'=> 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $result = ['status' => 200, 'message'=>'success'];

        try {
            $result['data'] = $this->salesService->saveSalesData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'message' =>$e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
   
}