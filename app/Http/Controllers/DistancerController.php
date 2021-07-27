<?php

namespace App\Http\Controllers;

use App\Helpers\CalcHelper;
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
    public function calculate(Request $request): Response
    {
        // Get request data after validation
        $distance1 = explode(' ', $request->input('distance1', 2));
        $distance2 = explode(' ', $request->input('distance2', 2));
        $returnUnit = $request->has('res_unit') ? $request->input('res_unit') : 'meters';

        // Calculate each distance separately respected to return unit
        $distance1Value = ($distance1[1] == $returnUnit) ? $distance1[0] : CalcHelper::{"$distance1[1]_to_$returnUnit"}($distance1[0]);
        $distance2Value = ($distance2[1] == $returnUnit) ? $distance2[0] : CalcHelper::{"$distance2[1]_to_$returnUnit"}($distance2[0]);

        // Calculate the total distance by adding the 2 values
        $result = $distance1Value + $distance2Value;

        return response([
            'data' => $result . ' ' . $returnUnit,
            'status' => 'success',
            'code' => 200
        ]);
    }
}
