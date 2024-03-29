<?php

namespace App\Services\Learning\Account;

use App\Models\Learning\Course\LearningCourse;
use App\Models\Learning\Course\LearningCourseView;
use App\Models\Learning\LearningCategory;
use App\Models\Learning\Module\LearningModule;
use App\Models\Learning\Module\LearningModuleView;
use App\Models\YaedpUser;
use Illuminate\Support\Facades\Auth;

/**
 * Class YaedpAccountService.
 */
class YaedpAccountService
{

    public static function yaedpId(){
        return LearningCategory::where('slug', 'yaedp')->first()->id;
    }

    public static function yaedpUser(){
        return new YaedpUser();
    }

    public function yaedpUserByEmail($email){
        return self::yaedpUser()->where('email', $email)->first();
    }

    public function yaedpSelectedUser($email)
    {
        return self::yaedpUser()
            ->with('export_selected_user')
            ->has('export_selected_user')
            ->where('email', $email)->first();
    }

    public static function yaedpUserWithRelationships(): \Illuminate\Database\Eloquent\Builder
    {
        return YaedpUser::with('learning_assessment', 'learning_module_assessments', 'state_origin', 'state_residence', 'export_selected_user');
    }

    public static function getModules(){
        return new LearningModule();
    }

    public static function getCourses(){
        return new LearningCourse();
    }

    public static function getCourseViews(){
       return LearningCourseView::where('learning_category_id', self::yaedpId());
    }

    public static function getModuleViews(){
        return LearningModuleView::where('learning_category_id', self::yaedpId());
    }

    public static function getCategoryModules(){
        return self::getModules()->with('learningCourses')
            ->has('learningCourses')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function findModuleById($id){
        return self::getModules()->where([
            ['learning_category_id', self::yaedpId()],
            ['id', $id]
        ])->first();
    }

    public static function getModulesWithRelationship(){
        return self::getModules()->with('learningCourses', 'learningCourseViews')
            ->has('learningCourses')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function getCategoryCourses(){
        return self::getCourses()->where('learning_category_id', self::yaedpId());
    }

    public static function getCoursesWithRelationship(){
        return self::getCourses()
            ->with('learningModule', 'learning_course_resources')
            ->where('learning_category_id', self::yaedpId());
    }

    public static function getCompletedCourses(){
        return self::getCourseViews()
            ->with('learningCourse', 'learningModule')->where([
                ['user_id', Auth::user()->id],
                ['status', 1],
            ]);
    }

    public static function getStartedCoursesWithLimit($num = null){
        return self::getCourseViews()
            ->with('learningCourse')->has('learningCourse')->where([
                ['user_id', Auth::user()->id],
            ])->orderBy('id', 'desc')->limit($num);
    }

    public static function getModuleProgress(){
        $moduleProgress = []; // create empty array
        // Loop through modules
        foreach(self::getCategoryModules()->get() as $mKey => $mValue){
            // loop through completed courses and get the number
            // of courses that has been completed for each module
            $moduleProgress[$mKey]['count'] = 0; // create count key in loop
            if(count(self::getCompletedCourses()->get()) > 0){
                foreach(self::getCompletedCourses()->get() as $cKey => $cValue){
                    if($cValue->learning_module_id === $mValue->id){
                        $moduleProgress[$mKey]['count']++;
                    }
                }
                // After looping the completedCourseViews
                // Assign array names to the percentage, id and name
                // Assign countCourseCompleted variable back to 0
                $moduleProgress[$mKey]['percent'] = ($moduleProgress[$mKey]['count'] / $mValue->learningCourses->count()) * 100;
                $moduleProgress[$mKey]['moduleId'] = $mValue->id;
                $moduleProgress[$mKey]['moduleTitle'] = $mValue->title;
            }
        }

        return $moduleProgress;
    }

    public static function getCoursesFromModuleId($id){
        return self::getCategoryCourses()->where([
                ['learning_module_id', $id],
                ['learning_category_id', self::yaedpId()],
            ]);
    }

    public static function getCourseById($id){
        return self::getCategoryCourses()->where([
            ['id', $id],
        ])->first();
    }

    public static function getCourseViewFromUser($id, $courseId, $moduleId){
        return self::getCourseViews()->where([
            ['user_id', $id],
            ['learning_course_id', $courseId],
            ['learning_module_id', $moduleId]
        ])->first();
    }

    public static function getModuleViewFromUser($id, $moduleId){
        return self::getModuleViews()->where([
            ['user_id', $id],
            ['learning_module_id', $moduleId]
        ])->first();
    }

    public static function addCourseViewByUser($id, $courseId, $moduleId){
        self::getCourseViews()->create([
            'user_id' => $id,
            'learning_course_id' => $courseId,
            'learning_module_id' => $moduleId,
            'learning_category_id' => self::yaedpId()
        ]);
    }

    public static function addModuleViewByUser($id, $moduleId){
        self::getModuleViews()->create([
            'user_id' => $id,
            'learning_module_id' => $moduleId,
            'learning_category_id' => self::yaedpId()
        ]);
    }

    public static function moduleStartedByUser($userId, $moduleId){
        return self::getModuleViews()->where([
            ['user_id', $userId],
            ['learning_module_id', $moduleId],
        ])->first();
    }

    public static function completeCourseViewForUser($userId, $courseId, $moduleId){
        // Check if course has been viewed
        $viewedCourse = self::getCourseViews()->where([
            ['user_id', $userId],
            ['learning_course_id', $courseId],
            ['learning_module_id', $moduleId],
            ['learning_category_id', self::yaedpId()],
            ['status', 0],
        ])->first();

        // if course has not been viewed, complete the course
        if($viewedCourse){
            $viewedCourse->status = 1;
            $viewedCourse->save();
        }
    }

}
