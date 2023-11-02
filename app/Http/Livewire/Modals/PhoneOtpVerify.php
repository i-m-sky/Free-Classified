<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class PhoneOtpVerify extends ModalComponent
{
    public $user;
    public $phone;
    public $otp;
    public $errorMessage;
    public $successMessage;

    public function mount($phone)
    {
        try {
            $this->getUserProfile();
            $this->phone = $phone;
            $this->errorMessage = null;
            $this->successMessage = null;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

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

    public function verifyOtp()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        $this->errorMessage = null;
        $this->successMessage = null;
        $validationRule = [];
        $validationRule['otp'] = ['required', 'regex:/^[\d]{4}$/'];
        $validationRule['phone'] = ['required', 'regex:/^[6-9]\d{9}$/', 'unique:users,phone,' . $this->user->id];
        $message = [];
        $message['otp.required'] = "OTP is required.";
        $message['otp.regex'] = "OTP should be numeric and 4 digits.";
        $message['phone.required'] = "Phone number is required.";
        $message['phone.regex'] = "Phone number should be numeric and 10 digits.";
        $message['phone.unique'] = "This phone number is already exists with us.";


        $this->validate($validationRule, $message);
        try {
            if (!empty($this->user)) {
                $response = verifyMobileOTP($this->phone, $this->otp);
                if ($response == 1) {
                    $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
                    User::where('id', $this->user->id)->update(['phone' =>  $this->phone, 'phone_verified_at' => $currentDateTime]);
                    $this->closeModal();
                    return redirect()->route('home');
                } else if ($response == 0) {
                    $this->errorMessage = "Your OTP doesn't match.";
                } else {
                    $this->errorMessage = $response;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end update

    public function resendOTP()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        $this->errorMessage = null;
        $this->successMessage = null;
        try {
            $response = reSendMobileOTP($this->phone);
            if ($response == true) {
                $this->successMessage = "OTP resent successfully.";
            } else {
                $this->errorMessage = "Please try after sometimes.";
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end resendOTP

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
        return view('livewire.modals.phone-otp-verify');
    }
}
