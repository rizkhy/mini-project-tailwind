<?php

namespace App\Livewire\Reimbursement;

use App\Enums\ReimbursementStatus;
use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ReimbursementPage extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $id;
    public $user_id;
    public $name;
    public $date;
    public $description;
    public $amount;
    public $file;
    public $status;
    public $updateMode = false;

    protected $queryString = ['search'];

    public function getReimbursementsProperty(): LengthAwarePaginator
    {
        return Reimbursement::latest()->paginate(5);
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

    public function saved()
    {
        DB::beginTransaction();

        $this->validate([
            'date' => 'required',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg',
        ]);

        $this->file->store('public/reimbursements');
        $path = $this->file->hashName();

        Reimbursement::create([
            'user_id' => auth()->id(),
            'date' => $this->date,
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'file' => 'reimbursements/' . $path,
            'status' => ReimbursementStatus::Pending,
        ]);

        $this->resetInput();

        DB::commit();
    }

    public function changeStatus($id, $status)
    {
        $reimbursement = Reimbursement::find($id);
        $reimbursement->update([
            'status' => $status,
        ]);
    }

    private function resetInput()
    {
        $this->name = '';
        $this->position = '';
        $this->nip = '';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.reimbursement.reimbursement-page')
            ->extends('layouts.app')
            ->section('content');
    }
}
