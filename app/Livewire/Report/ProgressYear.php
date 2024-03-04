<?php

namespace App\Livewire\Report;

use App\Models\RelateGroup;
use Livewire\Component;

class ProgressYear extends Component
{
    public function render()
    {
        $relates = RelateGroup::all();
        return view('livewire.report.progress-year', ['relates' => $relates]);
    }
}
