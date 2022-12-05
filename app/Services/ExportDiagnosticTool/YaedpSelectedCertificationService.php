<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\Yaedp\YaedpCertification;
use App\Services\Base\BaseService;
use App\Services\Base\CrudService;

/**
 * Class YaedpSelectedCertificationService.
 */
class YaedpSelectedCertificationService
{
    protected string $documentPath = 'documents/yaedp/certifications';

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

        if($input['date_issued'] > $input['valid_to' ]){
            return [
                'status' => false,
                'message' => 'Expiry date must be greater than issued date'
            ];
        }

        $input['user_id'] = $id;
        $input['document'] = CrudService::uploadDocument($request, $this->documentPath);

        // Add to product details
        $certification = $this->yaedpCertification()->create($input);

        return [
            'success' => true,
            'product' => $certification,
            'message' => 'Certification Submitted'
        ];
    }

    public function deleteUserCertification($userId, $certId): array
    {
        $cert = $this->yaedpCertification()->findOrFail($certId);
        if($cert->user_id !== $userId){
            return [
                'success' => false,
                'message' => 'You are not authorized to delete this item.'
            ];
        }
        CrudService::deleteFile($cert->document, $this->documentPath);
        return [
            'success' => true,
            'message' => 'Deleted'
        ];
    }

}
