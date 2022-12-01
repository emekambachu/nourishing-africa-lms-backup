<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\Yaedp\YaedpCertification;

/**
 * Class YaedpSelectedCertificationService.
 */
class YaedpSelectedCertificationService
{
    public function yaedpCertification(): YaedpCertification
    {
        return new YaedpCertification();
    }

    public function getYaedpCertificationByUserId($id){
        return $this->yaedpCertification()->where('user_id', $id);
    }

    public function addCertificationByUserId($request, $id): array
    {
        $input = $request->all();
        $input['user_id'] = $id;

        // Add to product details
        $certification = $this->yaedpCertification()->create($input);

        return [
            'success' => true,
            'product' => $certification,
            'message' => 'Certification Submitted'
        ];
    }
}
