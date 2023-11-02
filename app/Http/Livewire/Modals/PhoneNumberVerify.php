<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PhoneNumberVerify extends ModalComponent
{
    public $user;
    public $phone;
    public $errorMessage;

    public function mount()
    {
        try {
            $this->getUserProfile();
            $this->errorMessage = null;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function closeAllModal()
    {
        $this->forceClose()->closeModal();
    }


    private function getUserProfile()
    {
        try {
            $this->user =  User::where('id', Auth::id())->select(['id', 'phone'])->first();
            if (!empty($this->user)) {
                $this->phone =  $this->user->phone;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function updatePhoneNumber()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        $this->errorMessage = null;
        $validationRule = []; // 'unique:users,email,' . $this->user->id];
        $validationRule['phone'] = ['required', 'regex:/^[6-9]\d{9}$/', 'unique:users,phone,' . $this->user->id];
        $message = [];
        $message['phone.required'] = "Phone number is required.";
        $message['phone.regex'] = "Phone number should be numeric and 10 digits.";
        $message['phone.unique'] = "This phone number is already exists with us.";

        $this->validate($validationRule, $message);
        try {
            $user = Auth::user();
            if ($user->phone == $this->phone && !empty($user->phone_verified_at)) {
                $this->errorMessage = "This phone number is already verified.";
            } else {
                if (!empty($this->user)) {
                    $response = sendMobileOTP($this->phone);
                    if ($response == true) {
                        $this->emit("openModal", "modals.phone-otp-verify", (["phone" => $this->phone]));
                    } else {
                        $this->errorMessage = "Your phone number is invalid. Please check your number or try after sometimes.";
                    }
                    // User::where('id', $this->user->id)->update(['phone' =>  $this->phone, 'phone_verified_at' => NULL]);

                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end update

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.modals.phone-number-verify');
    }
}
