<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ErrorMessage extends ModalComponent
{
    public $errorMessage;

    public function mount($errorMessage = '')
    {
        try {
            $this->errorMessage = $errorMessage;
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
        return view('livewire.modals.error-message');
    }
}
