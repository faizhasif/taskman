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
     *      title="Projects Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Projects API Server"
     * )

     *
     * @OA\Tag(
     *     name="Projects",
     *     description="API Endpoints for Projects"
     * )
     * 
     * @OA\Tag(
     *      name="Tasks",
     *      description="API Endpoints for Tasks"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
