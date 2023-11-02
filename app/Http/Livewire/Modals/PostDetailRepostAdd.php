<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostDetailRepostAdd extends ModalComponent
{
    public $post;
    public $reportOption;
    public $comment;
    public $success;
    public $errorMessage;

    public function mount($post)
    {
        try {
            $this->post = $post;
            $this->success = false;
            $this->errorMessage = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function submitReport()
    {
        $this->success = false;
        $this->errorMessage = false;
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        if (Auth::id() != $this->post['user_id']) {
            $validationRule = [];
            $validationRule['reportOption'] = ['required'];
            $validationRule['comment'] = ['required', 'min:10', 'max:500'];
            $message = [];
            $message['reportOption.required'] = "Please select any reasom from above options.";
            $message['comment.required'] = "Please provide more information.";
            $message['comment.min'] = "Information should be greater than equal to 10 characters.";
            $message['comment.max'] = "Information should be less than equal to 500 characters.";
            $this->validate($validationRule, $message);
            try {
                DB::table('post_reports')->insert([
                    'user_id' => Auth::id(),
                    'post_id' => $this->post['id'],
                    'reason' => $this->reportOption,
                    'comment' => $this->comment,
                    'ip_address' =>  request()->ip()
                ]);
                $this->success = true;
                $this->errorMessage = false;
            } catch (\Throwable $th) {
                $this->success = false;
                $this->errorMessage = false;
            }
        } else {
            //$this->closeModal();
            $this->errorMessage = true;
        }
    } //end submitReport

    public function render()
    {
        return view('livewire.modals.post-detail-repost-add');
    }
}
