<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostPhoneViewHistory;
use App\Models\PostSentEmailHistory;
use App\Notifications\PostDetailUserNotification;
use stdClass;

class PostDetailEvents extends Component
{
    public $post;
    public $phone;
    public $whatsAppNumber;
    public $email;
    public $message;
    public $isEmailSent;

    public function mount($post)
    {
        try {
            $this->post = $post;
            $this->phone = 'Telephone';
            $this->whatsAppNumber = 'Whatsapp';
            $this->isEmailSent = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function showWhatsApp(Request $request)
    {
        try {
            $ip = request()->ip();
            $isTelephoneViewed = PostPhoneViewHistory::where('post_id', $this->post['id'])->where('visitor_type', 2)->where('visitor', $ip)->first();
            if (empty($isTelephoneViewed)) {
                PostPhoneViewHistory::create(['visitor_type' => 2, 'visitor' => $ip, 'post_id' => $this->post['id'], 'phone' => $this->post['user']['phone']]);
                DB::table('posts')->where('id', $this->post['id'])->update(['whatsApp_view' =>  DB::raw('IFNULL(whatsApp_view,0) + 1')]);
            }
            $this->whatsAppNumber = '+91-' . $this->post['user']['phone'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end showWhatsApp

    public function showTelephone(Request $request)
    {
        try {
            $ip = request()->ip();
            $isTelephoneViewed = PostPhoneViewHistory::where('post_id', $this->post['id'])->where('visitor_type', 1)->where('visitor', $ip)->first();
            if (empty($isTelephoneViewed)) {
                PostPhoneViewHistory::create(['visitor_type' => 1, 'visitor' => $ip, 'post_id' => $this->post['id'], 'phone' => $this->post['user']['phone']]);
                DB::table('posts')->where('id', $this->post['id'])->update(['phone_view' =>  DB::raw('IFNULL(phone_view,0) + 1')]);
            }
            $this->phone = '+91-' . $this->post['user']['phone'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end showMobile

    public function sendEnquiry()
    {
        $validationRule = [];
        $validationRule['email'] = 'required|email|max:100';
        $validationRule['message'] = 'required|max:255';
        $this->validate($validationRule);
        try {
            $ip = request()->ip();
            $isSentEmail = PostSentEmailHistory::where('post_id', $this->post['id'])->where('visitor', $ip)->first();
            if (empty($isSentEmail)) {
                DB::table('posts')->where('id', $this->post['id'])->update(['send_email' =>  DB::raw('IFNULL(send_email,0) + 1')]);
            }
            $emailRow = PostSentEmailHistory::create(['visitor' => $ip, 'post_id' => $this->post['id'], 'email' => $this->email, 'message' => $this->message]);
            $obj = new stdClass();
            $obj->userName = $this->post['user']['name'];
            $obj->userPhone = $this->post['user']['phone'];
            $obj->userEmail = $this->post['user']['email'];
           // $obj->notify(new PostDetailUserNotification($emailRow));
            $this->isEmailSent = true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end sendEnquiry

    public function render()
    {
        return view('livewire.posts.post-detail-events');
    }
}
