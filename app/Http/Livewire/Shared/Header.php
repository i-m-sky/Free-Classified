<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Header extends Component
{
    public $user;
    protected $listeners = ['refreshProfile'];

    public function mount()
    {
        try {
            $this->getUserProfile();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    private function getUserProfile()
    {
        try {
            $this->user =  User::where('id', Auth::id())->select(['name', 'photo', 'created_at'])->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function refreshProfile()
    {
        $this->getUserProfile();
    }

    public function render()
    {
        return view('livewire.shared.header');
    }
}
