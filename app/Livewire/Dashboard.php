<?php

namespace App\Livewire;

use Livewire\Component;
class Dashboard extends Component
{ 
    
    public function index()
    {
     
        return view('livewire.dashboard')->layout('layouts.main');
    }
}
