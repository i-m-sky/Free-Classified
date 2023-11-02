<?php

namespace App\Http\Livewire\Members\Profiles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Rules\IsSameNewPasswordAsCurrent;
use App\Notifications\ChangePasswordNotification;
use App\Models\User;

class ChangePassword extends Component
{
    public $password;
    public $current_password;
    public $password_confirmation;
    public $user;
    public $isSuccess;
    public $isVisibleCPassword;
    public $isVisibleNPassword;
    public $isVisibleCFPassword;

    public function mount()
    {
        try {
            $this->user =  Auth::user();
            $this->isSuccess = false;
            $this->isVisibleCPassword = false;
            $this->isVisibleNPassword = false;
            $this->isVisibleCFPassword = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function toggleVisibleCPassword()
    {
        try {
            $this->isVisibleCPassword = ($this->isVisibleCPassword === false) ? true : false;
        } catch (\Throwable $th) {
        }
    }

    public function toggleVisibleNPassword()
    {
        try {
            $this->isVisibleNPassword = ($this->isVisibleNPassword === false) ? true : false;
        } catch (\Throwable $th) {
        }
    }

    public function toggleVisibleCFPassword()
    {
        try {
            $this->isVisibleCFPassword = ($this->isVisibleCFPassword === false) ? true : false;
        } catch (\Throwable $th) {
        }
    }

    public function update()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        $validationRule = [];
        $validationRule['current_password'] =  ['required', new MatchOldPassword];
        $validationRule['password'] =  ['required', 'confirmed', 'min:8', 'max:30', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,30}$/',  new IsSameNewPasswordAsCurrent($this->current_password)];
        //  $validationRule['password'] = 'required|confirmed|min:8|max:30|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,30}$/m';
        $validationRule['current_password'] = ['required_with:password'];

        $message = [];
        $message['current_password.required'] = "Current password is required.";

        $message['password.required'] = "New password is required.";
        $message['password.min'] = "New password should be minimum 8 characters.";
        $message['password.max'] = "New password should be minimum 30 characters.";
        $message['password.regex'] = "New password should be at least one capital, one small, one number and one special characters.";
        $message['password.confirmed'] = "Confirm password doesn't match.";

        $this->validate($validationRule, $message);
        try {
            if (!empty($this->user)) {
                $row = User::find($this->user->id);
                $row->password =  Hash::make($this->password);
                $row->update();
                $row->notify(new ChangePasswordNotification($row, $this->password));
                $this->isSuccess = true;
                $this->password = '';
                $this->current_password = '';
                $this->password_confirmation = '';
            }
            Auth::logout();
            return redirect()->route('welcome');
        } catch (\Throwable $th) {
            Auth::logout();
            return redirect()->route('welcome');
        }
    } //end update

    public function render()
    {
        return view('livewire.members.profiles.change-password');
    }
}
