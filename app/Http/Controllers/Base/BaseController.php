<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Services\Base\BaseService;

class BaseController extends Controller
{
    public function getNigerianStates(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'states' => BaseService::nigerianStates()->orderBy('name')->get(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function countries(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'countries' => BaseService::countries()->orderBy('name')->get(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function allCountries(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'countries' => BaseService::allCountries()->orderBy('name')->get(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function focusAreas(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'focus_areas' => BaseService::focusAreas()->orderBy('name')->get(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function valueChains(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'value_chains' => BaseService::yaedpValueChains()->orderBy('name')->get(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
