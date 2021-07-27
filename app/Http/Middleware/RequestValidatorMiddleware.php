<?php

namespace App\Http\Middleware;

use App\Rules\DistanceUnitRule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

/**
 * RequestValidatorMiddleware class
 */

class RequestValidatorMiddleware
{
    use ProvidesConvenienceMethods;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->validate($request, [
            'distance1' => ['required', new DistanceUnitRule()],
            'distance2' => ['required', new DistanceUnitRule()],
            'res_unit' => [ValidationRule::in(['yards', 'meters'])]
        ]);

        return $next($request);
    }
}
