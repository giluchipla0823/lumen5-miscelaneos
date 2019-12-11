<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Traits\ResponseTransformer;

class ApiController extends Controller
{
    use ApiResponse, ResponseTransformer;
}
