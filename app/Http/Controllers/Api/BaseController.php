<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BaseService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function getStates(){
        try {
            return response()->json([
                'success' => true,
                'states' => BaseService::nigerianStates()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
