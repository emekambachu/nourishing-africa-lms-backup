<?php

namespace App\Services\Learning;

use App\Models\Learning\LearningDocumentUpload;
use App\Services\Base\CrudService;
use Illuminate\Support\Facades\Auth;

/**
 * Class DocumentUploadService.
 */
class DocumentUploadService extends CrudService
{
    protected $documentPath = 'documents/learning/yaedp';

    public function learningDocumentUpload(){
        return new LearningDocumentUpload();
    }

    public function learningDocumentUploadWithRelations(){
        return $this->learningDocumentUpload()->with('user');
    }

    public function learningDocumentUploadsById($id){
        return $this->learningDocumentUploadWithRelations()->findOrFail($id);
    }

    public function storeDocuments($request, $id){
        foreach($request->inputs as $key => $value){
            if($file = $request->file('inputs')[$key]['document']){
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path('/'.$this->documentPath.'/'), $name);
            }
            $this->learningDocumentUpload()->create([
                'yaedp_user_id' => $id,
                'title' => $value['title'],
                'document' => $name
            ]);
        }
    }

    public function deleteDocument($id){
        $document = $this->learningDocumentUploadsById($id);
        if($document->yaedp_user_id === Auth::user()->id){
            $this->deleteFile($document->document, $this->documentPath);
            $document->delete();
            return [
                'success' => true,
                'message' => 'Deleted'
            ];
        }
        return [
            'success' => false,
            'message' => 'Unable to delete'
        ];
    }

}
