<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyPostChangeStatus extends ModalComponent
{
    public $postId;
    public $status;
    public $loader;

    public function mount($postId, $status)
    {
        try {
            $this->postId = $postId;
            $this->status = $status;
            $this->loader = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function changeStatus()
    {
        try {
            $this->loader = true;
            if (!Auth::check()) {
                $this->emit('openModal', 'modals.error-message', ['errorMessage' => "You can change status after login only."]);
            } else {
                $row =  DB::table('posts')->select(['status', 'id', 'category_id', 'state_id', 'city_id', 'locality_id', 'user_id'])->find($this->postId);
                if (!empty($row)) {
                    if (Auth::id() != $row->user_id) {
                        $this->emit('openModal', 'modals.error-message', ['errorMessage' => "You cannot change the status. Please try after sometimes."]);
                        return true;
                    } else {
                        if ($this->status == 'active') {
                            if (!empty($row->category_id)) {
                                $categoryRow = DB::table('categories')->where('id', $row->category_id)->where('status', 'inactive')->first();
                                if (!empty($categoryRow)) {
                                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your are not able to inactive this post due to its category inactive"]);
                                    return true;
                                }
                            } //end category

                            if (!empty($row->state_id)) {
                                $stateRow = DB::table('states')->where('id', $row->state_id)->where('status', 'inactive')->first();
                                if (!empty($stateRow)) {
                                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your are not able to inactive this post due to its state inactive"]);
                                    return true;
                                }
                            } //end state

                            if (!empty($row->city_id)) {
                                $cityRow = DB::table('cities')->where('id', $row->city_id)->where('status', 'inactive')->first();
                                if (!empty($cityRow)) {
                                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your are not able to inactive this post due to its city inactive"]);
                                    return true;
                                }
                            } //end city

                            if (!empty($row->locality_id)) {
                                $localityRow = DB::table('localities')->where('id', $row->locality_id)->where('status', 'inactive')->first();
                                if (!empty($localityRow)) {
                                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your are not able to inactive this post due to its locality inactive"]);
                                    return true;
                                }
                            } //end locality
                        } //end status
                        DB::table('posts')->where('id', $row->id)->update(['status' => $this->status]);
                        $this->emitTo('members.posts.my-post', 'refreshMyPost');
                        $this->emit('openModal', 'modals.success-message', ['successMessage' => "Status has been changed successfully."]);
                    }
                } else {
                    $this->emit('openModal', 'modals.error-message', ['errorMessage' => "Your ad doesn't exists."]);
                    return true;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end changeStatus

    public function render()
    {
        return view('livewire.modals.my-post-change-status');
    }
}
