<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPhoneViewHistory;

class ProfileEvent extends Component
{
    public $user;
    public $phone;
    public $whatsAppNumber;

    public function mount($user)
    {
        try {
            $this->user = $user;
            $this->phone = 'Telephone';
            $this->whatsAppNumber = 'Whatsapp';
        } catch (\Throwable $th) {
        }
    } //end mount

    public function showWhatsApp(Request $request)
    {
        try {
            if ($this->user['id'] != Auth::id()) {
                $ip = request()->ip();
                $isTelephoneViewed = UserPhoneViewHistory::where('user_id', $this->user['id'])->where('visitor_type', 2)->where('visitor', $ip)->first();
                if (empty($isTelephoneViewed)) {
                    UserPhoneViewHistory::create(['visitor_type' => 2, 'visitor' => $ip, 'user_id' => $this->user['id'], 'phone' => $this->user['phone']]);
                    DB::table('users')->where('id', $this->user['id'])->update(['whatsApp_view' =>  DB::raw('IFNULL(whatsApp_view,0) + 1')]);
                }
            }

            $this->whatsAppNumber = '+91-' . $this->user['phone'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end showWhatsApp

    public function showTelephone(Request $request)
    {
        try {
            if ($this->user['id'] != Auth::id()) {
                $ip = request()->ip();
                $isTelephoneViewed = UserPhoneViewHistory::where('user_id', $this->user['id'])->where('visitor_type', 1)->where('visitor', $ip)->first();
                if (empty($isTelephoneViewed)) {
                    UserPhoneViewHistory::create(['visitor_type' => 1, 'visitor' => $ip, 'user_id' => $this->user['id'], 'phone' => $this->user['phone']]);
                    DB::table('users')->where('id', $this->user['id'])->update(['phone_view' =>  DB::raw('IFNULL(phone_view,0) + 1')]);
                }
            }
            $this->phone = '+91-' . $this->user['phone'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end showMobile

    public function render()
    {
        return view('livewire.profile.profile-event');
    }
}
