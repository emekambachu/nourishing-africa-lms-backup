<?php

namespace App\View\Components\Learning;

use App\Services\ExportDiagnosticTool\ExportSelectedUserService;
use App\Services\Learning\Account\YaedpAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SelectedUsersMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    // if public, it will be accessible from the view/blade file
    protected YaedpAccountService $yaedpUser;
    public function __construct(YaedpAccountService $yaedpUser)
    {
        $this->yaedpUser = $yaedpUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['selected'] = $this->yaedpUser->yaedpSelectedUser(Auth::user()->email);
        return view('yaedp.account.components.selected-users-menu', $data);
    }
}
