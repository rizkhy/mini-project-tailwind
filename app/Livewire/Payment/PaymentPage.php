<?php

namespace App\Livewire\Payment;

use App\Models\Reimbursement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentPage extends Component
{
    use WithPagination;

    public $updateMode = false;

    protected $queryString = ['search'];

    public function getReimbursementsProperty(): LengthAwarePaginator
    {
        return Reimbursement::where('status', 'approved')
            ->latest()
            ->paginate(5);
    }

    public function getStatusMessage($status)
    {
        switch ($status) {
            case 'pending':
                return '<div class="px-2 py-1 text-yellow-800 bg-yellow-200 rounded-md text-center">Pending</div>';
            case 'approved':
                return '<div class="px-2 py-1 text-green-800 bg-green-200 rounded-md text-center">Approved</div>';
            case 'rejected':
                return '<div class="px-2 py-1 text-red-800 bg-red-200 rounded-md text-center">Rejected</div>';
            default:
                return '<div class="px-2 py-1 text-gray-800 bg-gray-200 rounded-md text-center">Pending</div>';
        }
    }

    public function render()
    {
        return view('livewire.payment.payment-page')
            ->extends('layouts.app')
            ->section('content');
    }
}
