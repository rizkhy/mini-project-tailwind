<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserPage extends Component
{
    use WithPagination;

    public $id;
    public $name;
    public $position;
    public $nip;
    public $password;
    public $search;
    public $updateMode = false;

    protected $queryString = ['search'];

    public function getUsersProperty(): LengthAwarePaginator
    {
        return User::when(!empty($this->search), function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('position', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%');
        })->latest()->paginate(5);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->position = $user->position;
        $this->nip = $user->nip;

        $this->updateMode = true;
    }

    public function saved()
    {
        DB::beginTransaction();

        if ($this->updateMode) {

            $this->validate([
                'name' => 'required',
                'position' => 'required',
                'nip' => 'required',
                'password' => 'nullable',
            ]);

            $user = User::find($this->id);
            $user->update([
                'name' => $this->name,
                'position' => $this->position,
                'nip' => $this->nip,
                'password' => $this->password ? bcrypt($this->password) : $user->password,
            ]);
            $this->updateMode = false;
        } else {

            $this->validate([
                'name' => 'required',
                'position' => 'required',
                'nip' => 'required',
                'password' => 'required',
            ]);

            User::create([
                'name' => $this->name,
                'position' => $this->position,
                'nip' => $this->nip,
                'password' => bcrypt($this->password),
            ]);
        }

        $this->resetInput();

        DB::commit();
    }

    public function delete($id)
    {
        User::find($id)->delete();
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
        return view('livewire.user.user-page')
            ->extends('layouts.app')
            ->section('content');
    }
}
