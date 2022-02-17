<?php

namespace App\View\Components\Learning;

use App\Models\Learning\LearningCategory;
use App\Models\Learning\LearningModule;
use Illuminate\View\Component;

class YaedpMenu extends Component
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

        $data['categoryId'] = LearningCategory::where('slug', 'yaedp')->first()->id;
        $data['modules'] = LearningModule::where('learning_category_id', $data['categoryId'])
            ->orderBy('created_at', 'asc')->get();

        return view('yaedp.account.components.yaedp-menu', $data);
    }
}
