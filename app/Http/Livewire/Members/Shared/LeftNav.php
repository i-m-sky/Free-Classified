<?php

namespace App\Http\Livewire\Members\Shared;

use Livewire\Component;

class LeftNav extends Component
{
    public $row;

    public function mount($row)
    {
        try {
            $this->row = $row;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.members.shared.left-nav');
    }
}
