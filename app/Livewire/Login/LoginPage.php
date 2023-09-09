<?php

namespace App\Livewire\Login;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{
    public $nip;
    public $password;

    protected $rules = [
        'nip' => 'required|numeric',
        'password' => 'required',
    ];

    public function doLogin()
    {
        $this->validate();

        $user = User::where('nip', $this->nip)->first();

        if ($user) {
            if (\Hash::check($this->password, $user->password)) {
                session()->put('user', $user);
                Auth::guard()->login($user);

                return redirect()->route('dashboard');
            } else {
                session()->flash('error', 'Password salah');
            }
        } else {
            session()->flash('error', 'NIP tidak ditemukan');
        }
    }

    public function render()
    {
        return view('livewire.login.login-page')
            ->extends('layouts.auth')
            ->section('content');
    }
}
