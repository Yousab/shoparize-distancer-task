<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * DistancerController class
 */
class DistancerController extends BaseController
{
    /**
     * calculate the distance by adding 2 distance values
     * 
     * @param Request $request
     * @param Response
     */
    public function calculate(Request $request)
    {
        return response([
            'data' => 'Calculated Response',
            'status' => 'success',
            'code' => 200
        ]);
    }
}
