<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EdashboardNavigationMenu extends Component
{
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.edashboard-navigation-menu');
    }
}
