<?php

namespace App\Http\Livewire\Members\Profiles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PhoneEdit extends Component
{
    public $user;
    public $phone;
    public $phoneVerifiedAt;
    public $isVissibleVerified;

    public function mount()
    {
        try {
            $this->isVissibleVerified = false;
            $this->getUserProfile();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    private function getUserProfile()
    {
        try {
            $this->user =  User::where('id', Auth::id())->first();
            if (!empty($this->user)) {
                $this->phone =  $this->user->phone;
                $this->phoneVerifiedAt =  $this->user->phone_verified_at;
                if (!empty($this->phone)) {
                    $this->isVissibleVerified = true;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function render()
    {
        return view('livewire.members.profiles.phone-edit');
    }
}
