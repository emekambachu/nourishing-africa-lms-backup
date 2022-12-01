<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\ExportDiagnosticTool\YaedpSelectedProductService;
use App\Services\Learning\Account\YaedpAccountService;
use Illuminate\Http\Request;


class YaedpSelectedProductController extends Controller
{
    protected YaedpAccountService $yaedpUser;
    protected ExportSelectedUserService $selectedUser;
    protected YaedpSelectedProductService $product;

    public function __construct(
        YaedpAccountService $yaedpUser,
        ExportSelectedUserService $selectedUser,
        YaedpSelectedProductService $product
    ){
        $this->middleware(['auth:yaedp-users', 'export.selected']);
        $this->yaedpUser = $yaedpUser;
        $this->selectedUser = $selectedUser;
        $this->product = $product;
    }

    public function getUserProducts($id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->product->getYaedpProductsByUserId($id)->latest()->get();
            return response()->json([
                'success' => true,
                'products' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function addUserProduct(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->product->addProductByUserId($request, $id);
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateUserProduct($userId, $productId): \Illuminate\Http\JsonResponse
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

    public function deleteUserProduct($userId, $productId): \Illuminate\Http\JsonResponse
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
