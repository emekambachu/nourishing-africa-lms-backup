<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\Yaedp\YaedpBusinessDetail;

/**
 * Class YaedpSelectedBusinessService.
 */
class YaedpSelectedBusinessService
{
    protected ExportSelectedUserService $selectedUser;
    public function __construct(ExportSelectedUserService $selectedUser){
        $this->selectedUser = $selectedUser;
    }

    protected string $imagePath = 'photos/yaedp/business';

    public function yaedpBusinessDetail(): YaedpBusinessDetail
    {
        return new YaedpBusinessDetail();
    }

    public function getYaedpBusinessByUserId($id){
        return $this->yaedpBusinessDetail()->where('user_id', $id);
    }
}
