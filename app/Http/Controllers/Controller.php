<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="API by wassim assi",
     *      description="api with passport auth and larvel 8",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * @OA\SecurityScheme(
     *    securityScheme="passport",
     *    in="header",
     *    name="passport",
     *    type="http",
     *    scheme="bearer",
     *    bearerFormat="JWT",
     * ),
     *
     *
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
