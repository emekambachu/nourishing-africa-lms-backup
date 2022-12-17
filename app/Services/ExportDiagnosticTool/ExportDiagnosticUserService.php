<?php

namespace App\Services\ExportDiagnosticTool;

use App\Exports\ExportDiagnosticTool\ExportDiagnosticToolUsers;
use App\Models\ExportDiagnosticTool\ExportDiagnosticAnswer;
use App\Models\ExportDiagnosticTool\ExportDiagnosticHiddenQuestion;
use App\Models\ExportDiagnosticTool\ExportDiagnosticUser;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ExportDiagnosticToolService.
 */
class ExportDiagnosticUserService extends BaseService
{
    public function exportDiagnosticUser(): ExportDiagnosticUser
    {
        return new ExportDiagnosticUser();
    }

    public function exportDiagnosticUserWithRelations(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->exportDiagnosticUser()
            ->with('user', 'user.state_origin', 'user.state_residence', 'export_diagnostic_answers', 'export_diagnostic_answers.export_diagnostic_question', 'export_diagnostic_hidden_question');
    }

    public function hiddenQuestions(): ExportDiagnosticHiddenQuestion
    {
        return new ExportDiagnosticHiddenQuestion();
    }

    public function exportDiagnosticAnswer(): ExportDiagnosticAnswer
    {
        return new ExportDiagnosticAnswer();
    }

    public function searchUsers($request): array
    {
        $input = $request->all();
        $request->session()->forget(['search_inputs', 'search_values']);

        // Create empty array for search values session
        // Add all input to search inputs session, can be easily passed to export functionality
        $request->session()->put('search_values', []);
        $request->session()->put('search_inputs', $input);

        if(!empty($input['term'])) {
            $request->session()->push('search_values', ['term' => $input['term']]);
        }

        if(!empty($input['state_origin'])){
            $request->session()->push('search_values', ['state_origin' => self::nigerianStateById($input['state_origin'])->name]);
        }

        if(!empty($input['state_residence'])){
            $request->session()->push('search_values', ['state_origin' => self::nigerianStateById($input['state_residence'])->name]);
        }

        if(!empty($input['focus_area'])){
            $request->session()->push('search_values', ['focus_area' => $input['focus_area']]);
        }
        if(!empty($input['value_chain'])){
            $request->session()->push('search_values', ['value_chain' => $input['value_chain']]);
        }
        if(!empty($input['company_registered'])) {
            if ($input['company_registered'] === '1') {
                $request->session()->push('search_values', ['company_registered' => 'Company Registered']);
            } else {
                $request->session()->push('search_values', ['company_registered' => 'Company Un-registered']);
            }
        }

        if(!empty($input['gender'])){
            $request->session()->push('search_values', ['gender' => $input['gender']]);
        }

        if(!empty($input['company_type'])){
            $request->session()->push('search_values', ['company_type' => $input['company_type']]);
        }

        if(!empty($input['percentage_score'])){
            if($input['percentage_score'] === "1"){
                $request->session()->push('search_values', ['percentage_score' => '90% - 100%']);
            }
            if($input['percentage_score'] === "2"){
                $request->session()->push('search_values', ['percentage_score' => '70% - 89%']);
            }
            if($input['percentage_score'] === "3"){
                $request->session()->push('search_values', ['percentage_score' => '60% - 69%']);
            }
            if($input['percentage_score'] === "4"){
                $request->session()->push('search_values', ['percentage_score' => 'Less than 60%']);
            }
        }

        if(!empty($input['completed'])){
            $request->session()->push('search_values', ['completed' => $input['completed']]);
        }

        $users = $this->exportDiagnosticUserWithRelations()
            ->select('export_diagnostic_users.*',
                'export_diagnostic_users.id AS export_diagnostic_user_id',
                'export_diagnostic_users.yaedp_user_id AS diagnostic_yaedp_user_id',
                'yedp_users.id AS yaedp_user_id')
            ->leftjoin('yedp_users', 'yedp_users.id', '=', 'export_diagnostic_users.yaedp_user_id')
            ->where('export_diagnostic_users.status', 0)
            ->where(function($query) use ($input){
                // The rest of the queries can come here
                $query->when(!empty($input['term']), static function($q) use($input){
                    $q->where('yedp_users.first_name', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.surname', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.email', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.mobile', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.gender', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.business', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yedp_users.location', 'like' , '%'. $input['term'] .'%');
                });

            })->when(!empty($input['state_residence']), static function ($q) use($input){
                return $q->where('state_residence', $input['state_residence']);

            })->when(!empty($input['state_origin']), static function ($q) use($input){
                return $q->where('state_origin', $input['state_origin']);

            })->when(!empty($input['company_type']), static function ($q) use($input){
                return $q->where('company_type', $input['company_type']);

            })->when(!empty($input['focus_area']), static function ($q) use($input){
                return $q->where('focus_area', $input['focus_area']);

            })->when(!empty($input['value_chain']), static function ($q) use($input){
                return $q->where('value_chain', $input['value_chain']);

            })->when(!empty($input['gender']), static function ($q) use($input){
                return $q->where('gender', $input['gender']);

            })->when(!empty($input['company_registered']), static function ($q) use($input){
                if($input['company_registered'] === 1){
                    return $q->where('company_legal', 1);
                }
                return $q->where('company_legal', 0);

            })->when(!empty($input['percentage_score']), static function ($q) use($input){
                if($input['percentage_score'] === "1"){
                    return $q->where('percent', '>=' ,90);
                }
                if($input['percentage_score'] === "2"){
                    return $q->where('percent', '>=' ,70)->where('percent', '<', 90);
                }
                if($input['percentage_score'] === "3"){
                    return $q->where('percent', '>=' ,60)->where('percent', '<', 70);
                }
                if($input['percentage_score'] === "4"){
                    return $q->where('percent', '<' ,60);
                }
                return null;

            })->when(!empty($input['completed']), static function ($q) use($input){
                if($input['completed'] === "yes"){
                    return $q->where('completed', 1);
                }
                if($input['completed'] === "no"){
                    return $q->where('completed', 0);
                }
                return null;

            })->paginate(15);

        // if result exists return results, else return empty array
        if($users->total() > 0){
            return [
                'users' => $users,
                'total' => $users->total(),
                'search_values' => $request->session()->get('search_values')
            ];
        }

        return [
            'users' => [],
            'total' => 0,
            'search_values' => $request->session()->get('search_values')
        ];
    }

    public function exportUsers(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $input = [];
        if(Session::has('search_inputs')){
            foreach(Session::get('search_inputs') as $key => $value){
                if($key !== 'page'){
                    $input[$key] = $value;
                }
            }
        }
        // forget session after storing into $input array
        Session::forget('search_inputs');
        $diagnosticUser = $this->exportDiagnosticUserWithRelations();
        return Excel::download(new ExportDiagnosticToolUsers($input, $diagnosticUser), 'export-diagnostic-tool-users-result.xlsx');
    }

    public function deleteUserWithAnswers($id): void
    {
        $user = $this->exportDiagnosticUserWithRelations()->findOrFail($id);
        // Delete hidden questions
        $this->hiddenQuestions()->where('yaedp_user_id', $user->yaedp_user_id)->delete();
        // Delete user answers
        $answers = $this->exportDiagnosticAnswer()->where('yaedp_user_id', $user->yaedp_user_id)->get();
        if($answers->count() > 0){
            foreach($answers as $answer){
                $answer->delete();
            }
        }
        $user->delete();
    }
}
