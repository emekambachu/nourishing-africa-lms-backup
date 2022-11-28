<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\ExportDiagnosticTool\YaedpSelectedProductService;
use App\Services\Learning\Account\YaedpAccountService;

class YaedpSelectedCertificationController extends Controller
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


}
