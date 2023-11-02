<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserDeleteNotification;
use App\Models\User;

class MyAccountDeleteConfirmation extends ModalComponent
{
    public $loader;

    public function mount()
    {
        try {
            $this->loader = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function deleteAccount(Request $request)
    {
        try {
            $this->loader = true;
            if (!Auth::check()) {
                $this->emit('openModal', 'modals.error-message', ['errorMessage' => "You can change status after login only."]);
            } else {
                $user = User::find(Auth::id());
                if (!empty($user)) {
                    DB::table('posts')->where('user_id', $row->id)->delete();
                    $user->delete();
                    $user->notify(new UserDeleteNotification($user));
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/');
                } else {
                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your ad doesn't exists."]);
                    return true;
                }
            }
        } catch (\Throwable $th) {
            $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Please try after sometimes."]);
            return true;
        }
    } //end 

    public function render()
    {
        return view('livewire.modals.my-account-delete-confirmation');
    }
}
