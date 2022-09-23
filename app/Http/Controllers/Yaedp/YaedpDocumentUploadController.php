<?php

namespace App\Http\Controllers\Yaedp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Yaedp\SubmitDocumentRequest;
use App\Services\Learning\DocumentUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YaedpDocumentUploadController extends Controller
{
    private $document;
    public function __construct(DocumentUploadService $document){
        $this->document = $document;
        $this->middleware('auth:yaedp-users');
    }

    public function index(){
        return view('yaedp.account.document-uploads.index');
    }

    public function getDocuments(): \Illuminate\Http\JsonResponse
    {
        try {
            $documents = $this->document->learningDocumentUpload()->get();
            return response()->json([
                'success' => true,
                'documents' => $documents,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(SubmitDocumentRequest $request){
        try {
            $this->document->storeDocuments($request, Auth::user()->id);
            return response()->json([
                'success' => true,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        try {
            $data = $this->document->deleteDocument($id);
            return response()->json([
                'success' => $data['success'],
                'message' => $data['message'],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
