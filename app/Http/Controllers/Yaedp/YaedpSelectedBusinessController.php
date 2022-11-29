<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\ExportDiagnosticTool\YaedpSelectedBusinessService;
use App\Services\ExportDiagnosticTool\YaedpSelectedProductService;
use App\Services\Learning\Account\YaedpAccountService;
use Illuminate\Http\Request;

class YaedpSelectedBusinessController extends Controller
{
    protected ExportSelectedUserService $selectedUser;
    protected YaedpSelectedBusinessService $business;

    public function __construct(
        ExportSelectedUserService $selectedUser,
        YaedpSelectedBusinessService $business
    ){
        $this->middleware(['auth:yaedp-users', 'export.selected']);
        $this->selectedUser = $selectedUser;
        $this->business = $business;
    }

    public function getUserBusiness($id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->business->getYaedpBusinessByUserId($id);
            return response()->json([
                'success' => true,
                'business' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function addUserBusiness(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->business->addBusinessByUserId($request, $id);
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
