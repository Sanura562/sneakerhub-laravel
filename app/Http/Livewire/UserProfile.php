<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    // public function updateProfile()
    // {
    //     $this->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //     ]);

    //     $user = Auth::user();
    //     $user->name = $this->name;
    //     $user->email = $this->email;
    //     $user->save();

    //     session()->flash('message', 'Profile updated successfully!');
    // }

    public function render()
    {
        return view('livewire.user-profile');
    }
}