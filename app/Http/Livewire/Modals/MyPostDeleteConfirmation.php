<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostDeleteNotification;
use App\Models\User;

class MyPostDeleteConfirmation extends ModalComponent
{
    public $postId;
    public $loader;

    public function mount($postId)
    {
        try {
            $this->postId = $postId;
            $this->loader = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function deleteMyPost()
    {
        try {
            $this->loader = true;
            if (!Auth::check()) {
                $this->emit('openModal', 'modals.error-message', ['errorMessage' => "You can change status after login only."]);
            } else {
                $row =  DB::table('posts')->find($this->postId);
                if (!empty($row)) {
                    if (Auth::id() != $row->user_id) {
                        $this->emit('openModal', 'modals.error-message', ['errorMessage' => "You cannot delete this ad. Please try after sometimes."]);
                        return true;
                    } else {
                        $user = User::find(Auth::id());
                        DB::table('posts')->where('id', $row->id)->delete();
                        $user->notify(new PostDeleteNotification($user, $row));
                        $this->emitTo('members.posts.my-post', 'refreshMyPost');
                        $this->emit('openModal', 'modals.success-message', ['successMessage' => "Your ad has been deleted successfully."]);
                    }
                } else {
                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your ad doesn't exists."]);
                    return true;
                }
            }
        } catch (\Throwable $th) {
            $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Please try after sometimes."]);
            return true;
        }
    } //end deleteMyPost


    public function render()
    {
        return view('livewire.modals.my-post-delete-confirmation');
    }
}
