<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\ExportDiagnosticTool\YaedpSelectedProductService;
use App\Services\Learning\Account\YaedpAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YaedpSelectedUserController extends Controller
{
    protected YaedpAccountService $yaedpUser;
    protected ExportSelectedUserService $selecteduser;
    protected YaedpSelectedProductService $product;

    public function __construct(
        YaedpAccountService $yaedpUser,
        ExportSelectedUserService $selecteduser,
        YaedpSelectedProductService $product
    ){
        $this->middleware(['auth:yaedp-users', 'export.selected']);
        $this->yaedpUser = $yaedpUser;
        $this->selecteduser = $selecteduser;
        $this->product = $product;
    }

    public function businessProfile(){
        $data['yaedpUser'] = $this->yaedpUser->yaedpUserByEmail(Auth::user()->email);
        $data['selectedUser'] = $this->selecteduser->exportSelectedUserByEmail(Auth::user()->email);
        return view('yaedp.account.selected-users.business-profile', $data);
    }

    public function getBusinessProfile($email): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $this->selecteduser->exportSelectedUserByEmail($email);
            return response()->json([
                'success' => true,
                'user' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function exportResources(){
        $data['yaedpUser'] = $this->yaedpUser->yaedpUserByEmail(Auth::user()->email);
        $data['selectedUser'] = $this->selecteduser->exportSelectedUserByEmail(Auth::user()->email);
        return view('yaedp.account.selected-users.export-resources', $data);
    }
}
