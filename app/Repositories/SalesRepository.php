<?php

namespace App\Repositories;

use App\Models\Sales;

class SalesRepository
{
    /**
     * @var Sales
     */
    protected $sales;

    /**
     * SalesRepository constructor.
     *
     * @param Sales $sales
     */
    public function __construct()
    {
        $this->sales = new Sales();

    }

    /**
     * Get all vehicles.
     *
     * @return Sales $sales
     */
    public function getAll()
    {
        return$this->sales->get();
    }


    /**
     * Save Sales
     *
     * @param $data
     * @return Sales
     */
    public function save($data)
    {
        $sales = new $this->sales;
        $sales->item = $data['item']->getAttributes();
        $sales->price = $data['price'];
        $sales->qty = $data['qty'];
        $sales->grand_total = $data['grand_total'];

        $sales->save();

        return $sales->fresh();
    }


}