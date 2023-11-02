<?php

namespace App\Http\Livewire\Members\Profiles;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileImage extends Component
{
    use WithFileUploads;
    public $user;

    protected $listeners = ['setLocationMyProfile'];

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
            $this->user =  User::where('id', Auth::id())->select(['name', 'photo'])->first();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function render()
    {
        return view('livewire.members.profiles.profile-image');
    }
}
