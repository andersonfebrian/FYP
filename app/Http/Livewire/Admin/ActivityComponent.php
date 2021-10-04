<?php

namespace App\Http\Livewire\Admin;

use App\Models\Activity;
use Livewire\Component;

class ActivityComponent extends Component
{
    public function render()
    {

        $activities = Activity::orderBy('created_at', 'desc')->get();

        return view('livewire.admin.activity-component', ['activities' => $activities]);
    }
}
