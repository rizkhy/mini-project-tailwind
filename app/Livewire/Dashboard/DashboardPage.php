<?php

namespace App\Livewire\Dashboard;

use App\Models\Reimbursement;
use App\Models\User;
use Livewire\Component;

class DashboardPage extends Component
{
    public $user;
    public $reimbursement;

    public function mount()
    {
        $this->user = User::count();
        $this->reimbursement = Reimbursement::count();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-page')
            ->extends('layouts.app')
            ->section('content');
    }
}
