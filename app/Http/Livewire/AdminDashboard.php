<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;

class AdminDashboard extends Component
{
    public $users;
    public $orders;

    public function mount()
    {
        $this->users = User::all();
        $this->orders = Order::all(); // Or fake data for now
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}