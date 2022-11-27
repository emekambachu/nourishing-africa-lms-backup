<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\ExportDiagnosticTool\ExportSelectedUser;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\Session;

/**
 * Class ExportSelectedUserService.
 */
class ExportSelectedUserService
{
    public function exportSelectedUser(): ExportSelectedUser
    {
        return new ExportSelectedUser();
    }

    public function exportSelectedUserRelations(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->exportSelectedUser()->with('user', 'business')->has('user');
    }

    public function exportSelectedUserById($id){
        return $this->exportSelectedUserRelations()->findOrFail($id);
    }

    public function exportSelectedUserByEmail($email){
        return $this->exportSelectedUserRelations()->where('email', $email)->first();
    }

    public function searchUsers($request): array
    {
        $input = $request->all();
        $request->session()->forget(['search_inputs', 'search_values']);

        $searchValues = [];

        if(!empty($input['term'])) {
            $searchValues['term'] = $input['term'];
        }

        if(!empty($input['state_residence'])){
            $searchValues['state_residence'] = $input['state_residence'];
        }

        if(!empty($input['focus_area'])){
            $searchValues['focus_area'] = $input['focus_area'];
        }
        if(!empty($input['value_chain'])){
            $searchValues['value_chain'] = $input['value_chain'];
        }

        if(!empty($input['company_registered'])) {
            if ($input['company_registered'] === '1') {
                $searchValues['company_registered'] = "Registered Company";
            } else {
                $searchValues['company_registered'] = "Un-registered Company";
            }
        }

        if(!empty($input['gender'])){
            $searchValues['gender'] = $input['gender'];
        }

        if(!empty($input['company_type'])){
            $searchValues['company_type'] = $input['company_type'];
        }

        $request->session()->put('search_values', $searchValues);

        $users = $this->exportSelectedUserRelations()->select(
                'yaedp_selected_users.*',
                'yedp_users.*',
                'yedp_users.email AS yaedp_users_email',
                'yedp_users.gender AS yaedp_users_gender',
                'yedp_users.mobile AS yaedp_users_mobile',
                'yedp_users.focus_area AS yaedp_users_focus_area',
                'yedp_users.value_chain AS yaedp_users_vale_chain',
            )->leftjoin('yedp_users',
                'yedp_users.email', '=', 'yaedp_selected_users.email'
            )->where(function($query) use ($input){
                $query->when(!empty($input['term']), static function($q) use($input){
                    $q->where('yaedp_selected_users.name', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.email', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.mobile', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.gender', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.business_name', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.state', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.value_chain', 'like' , '%'. $input['term'] .'%')
                        ->orWhere('yaedp_selected_users.focus_area', 'like' , '%'. $input['term'] .'%');
                });

            })->when(!empty($input['state_residence']), static function ($q) use($input){
                return $q->where('yaedp_selected_users.state', $input['state_residence']);

            })->when(!empty($input['company_type']), static function ($q) use($input){
                return $q->where('yedp_users.company_type', $input['company_type']);

            })->when(!empty($input['focus_area']), static function ($q) use($input){
                return $q->where('yaedp_selected_users.focus_area', $input['focus_area']);

            })->when(!empty($input['value_chain']), static function ($q) use($input){
                return $q->where('yaedp_selected_users.value_chain', $input['value_chain']);

            })->when(!empty($input['gender']), static function ($q) use($input){
                return $q->where('yaedp_selected_users.gender', $input['gender']);

            })->when(!empty($input['company_registered']), static function ($q) use($input){
                if($input['company_registered'] === 1){
                    return $q->where('yedp_users.company_legal', 1);
                }
                return $q->where('yedp_users.company_legal', 0);

            })->paginate(15);

        // if result exists return results, else return empty array
        if($users->total() > 0){
            return [
                'success' => true,
                'users' => $users,
                'total' => $users->total(),
                'search_values' => Session::get('search_values')
            ];
        }

        return [
            'success' => false,
            'users' => [],
            'total' => 0,
            'search_values' => Session::get('search_values')
        ];
    }
}
