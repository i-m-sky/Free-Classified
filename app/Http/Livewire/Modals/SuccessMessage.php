<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SuccessMessage extends ModalComponent
{
    public $successMessage;

    public function mount($successMessage = '')
    {
        try {
            $this->successMessage = $successMessage;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function closeAllModal()
    {
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.success-message');
    }
}
