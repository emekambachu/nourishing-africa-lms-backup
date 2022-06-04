<?php

namespace App\Services\Learning\Account;

use App\Models\Learning\LearningAssessment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

/**
 * Class YaedpAssessmentService.
 */
class YaedpAssessmentService extends YaedpAccountService
{
    public static function getAssessments(){
        return new LearningAssessment();
    }

    public static function getCategoryAssessments(){
        return LearningAssessment::where('learning_category_id', self::yaedpId());
    }

    public static function getAssessmentsWithRelationships(){
        self::getAssessments()->with('learning_category', 'yaedp_user');
    }


    public static function getModuleAssessmentsWithLimit($num = null){
        return self::getModuleViews()->where([
            ['user_id', Auth::user()->id],
            ['status', 1],
            ['learning_category_id', self::yaedpId()]
        ])->latest()->limit($num);
    }

    public static function exhaustedRetakesByUser($userId, $moduleId, $retakes){
        self::getModuleViews()->where([
            ['user_id', $userId],
            ['learning_module_id', $moduleId],
            ['retake', $retakes],
        ])->first();
    }

    public static function moduleAssessmentPassedByUser($userId, $moduleId){
        self::getModuleViews()->where([
            ['user_id', $userId],
            ['learning_module_id', $moduleId],
            ['passed', 1],
        ])->first();
    }

    public static function generateCertificateForUser($userId, $firstName, $surname){

        // Certificate image path and type
        $path = 'images/icons/certificate_yaedp_700.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64_image = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // check if certificate has been downloaded
        $downloaded = self::getCategoryAssessments()->where([
            ['user_id', $userId],
            ['certificate_downloads', '>', 0],
            ['certificate_id', '<>', null],
        ])->first();

        // If certificate has not been downloaded, generate certificate id and create record
        // If certificate has already been downloaded increase download count++ and save
        if(!$downloaded){
            function certificateId($length = 11){
                $characters = '0123456789';
                $charactersLength = strlen($characters);
                $randomString = 'YAEDP';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[random_int(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $downloaded = self::getCategoryAssessments()->where('user_id', $userId)->first();
            $downloaded->certificate_downloads = 1;
            $downloaded->certificate_id = certificateId();
        }else{
            ++$downloaded->certificate_downloads;
        }
        $downloaded->save();

        // return certificate data to be downloaded with controller
        return [
            'name' => $firstName . ' ' . $surname,
            'current_date' => Carbon::now()->format('jS \\of F Y'),
            'certificate_image' => $base64_image,
            'certificate_id' => $downloaded->certificate_id,
        ];

    }
}
