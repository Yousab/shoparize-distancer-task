<?php

/**
 * DistancerTest is a test file to test distance calculations API
 */

class DistancerTest extends TestCase
{
    /**
     * Test the success response from the calculate API
     *
     * @return void
     */
    public function testSuccessResponse(): void
    {
        $this->json('POST', '/api/v1/calculate', ['distance1' => '3 yards', 'distance2' => '5 meters'])
            ->seeJson([
                'status' => 'success',
            ]);
    }

    /**
     * Test the required params existance
     * 
     * @return void
     */
    public function testRequestParamsExistance(): void
    {
        $response = $this->call('POST', '/api/v1/calculate', ['distance2' => '5 meters']);
        $response->assertJsonValidationErrors('distance1', $responseKey = null);

        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3 yards']);
        $response->assertJsonValidationErrors('distance2', $responseKey = null);
    }

    /**
     * Test the params expected units
     * 
     * @return void
     */
    public function testRequestParamUnits(): void
    {
        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3 yards', 'distance2' => '5 kilometers']);
        $response->assertJsonValidationErrors('distance2', $responseKey = null);

        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3 inches', 'distance2' => '5 meters']);
        $response->assertJsonValidationErrors('distance1', $responseKey = null);
    }

    /**
     * Test the params pattern with unexpected numeric value
     * 
     * @return void
     */
    public function testRequestParamNumericValue(): void
    {
        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3w yards', 'distance2' => '5 meters', 'res_unit' => 'meters']);
        $response->assertJsonValidationErrors('distance1', $responseKey = null);

        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3 yards', 'distance2' => 'w5 meters', 'res_unit' => 'meters']);
        $response->assertJsonValidationErrors('distance2', $responseKey = null);
    }

    /**
     * Test the return type unit if exists
     * 
     * @return void
     */
    public function testReturnTypeUnit(): void
    {
        $response = $this->call('POST', '/api/v1/calculate', ['distance1' => '3 yards', 'distance2' => '5 meters', 'res_unit' => 'inches']);
        $response->assertJsonValidationErrors('res_unit', $responseKey = null);
    }
}
