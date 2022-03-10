<?php

namespace App\View\Components\Learning;

use App\Models\Learning\LearningAccountNotification;
use Illuminate\View\Component;

class AccountNotificationComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){

        $data['getNotifications'] = new LearningAccountNotification();
        $data['dropDownNotification'] = $data['getNotifications']->latest()->limit(3)->get();
        $data['countNotifications'] = $data['getNotifications']->where('opened', 0)->count();

        return view('yaedp.account.components.account-notification', $data);
    }
}
