<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\ExportDiagnosticTool\YaedpSelectedCertificationService;
use Illuminate\Http\Request;

class YaedpSelectedCertificationController extends Controller
{
    protected ExportSelectedUserService $selectedUser;
    protected YaedpSelectedCertificationService $certificate;

    public function __construct(
        ExportSelectedUserService $selectedUser,
        YaedpSelectedCertificationService $certificate
    ){
        $this->middleware(['auth:yaedp-users', 'export.selected']);
        $this->selectedUser = $selectedUser;
        $this->certificate = $certificate;
    }

    public function getUserCertifications($id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->certificate->getYaedpCertificationByUserId($id)->latest()->get();
            return response()->json([
                'success' => true,
                'certifications' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function addUserCertification(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->certificate->addCertificationByUserId($request, $id);
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateUserCertification($userId, $productId): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Deleted',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteUserCertification($userId, $productId): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Deleted',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

}
