<?php

namespace App\Http\Livewire\Members\Profiles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\City;
use App\Models\Locality;
use App\Notifications\VerifyEmail;

class ProfileEdit extends Component
{
    public $user;
    public $email;
    public $name;
    public $location;
    public $locationId;
    public $locationType;
    public $about;
    public $emailVerifiedAt;
    public $isSuccess;
    protected $listeners = ['setLocationMyProfile'];

    public function mount()
    {
        try {
            $this->getUserProfile();
            $this->isSuccess = false;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function setLocationMyProfile($id, $name, $type)
    {
        $this->location = $name;
        $this->locationId = $id;
        $this->locationType = $type;
    } //end setLocation

    private function getUserProfile()
    {
        try {
            $this->user =  User::where('id', Auth::id())->first();
            if (!empty($this->user)) {
                $this->email =  $this->user->email;
                $this->name =  $this->user->name;
                $this->emailVerifiedAt =  $this->user->email_verified_at;
                $this->about = $this->user->about;
                if (!empty($this->user->locality_id)) {
                    $this->location = $this->user->locality->name;
                    $this->locationId = $this->user->locality_id;
                    $this->locationType = 'locality';
                } elseif (!empty($this->user->city_id)) {
                    $this->location = $this->user->city->name;
                    $this->locationId = $this->user->city_id;
                    $this->locationType = 'city';
                } elseif (!empty($this->user->state_id)) {
                    $this->location = $this->user->state->name;
                    $this->locationId = $this->user->state_id;
                    $this->locationType = 'state';
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function updateProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
        $validationRule = [];
        $validationRule['name'] = ['required', 'string', 'max:255'];
        $validationRule['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id];
        $validationRule['about'] = ['nullable', 'string', 'max:1000']; //'required',
        $validationRule['location'] = ['required'];
        $validationRule['locationId'] = ['required'];
        $validationRule['locationType'] = ['required'];

        $message = [];
        $message['name.required'] = "Name is required.";
        $message['name.string'] = "Name should be string.";
        $message['name.max'] = "Name should be maximum 255 characters.";
        $message['email.required'] = "Email is required.";
        $message['email.string'] = "Email should be string.";
        $message['email.email'] = "Email should be valid email address.";
        $message['email.max'] = "Email should be maximum 255 characters.";
        $message['email.exists'] = "Email is already exists with us.";
        $message['location.required'] = "Location is required.";
        $message['locationId.required'] = "Location is required.";
        $message['locationType.required'] = "Location is required.";
        $message['about.required'] = "Information about yourself is required.";
        $message['about.string'] = "Information about yourself should be string";
        $message['about.max'] = "Information about yourself should be maximum 1000 characters.";

        $this->validate($validationRule, $message);
        try {
            if (!empty($this->user)) {
                $row = User::find($this->user->id);
                $oldEmail = $row->email;
                $row->name = $this->name;
                $row->about = $this->about;
                $row->state_id = null;
                $row->city_id = null;
                $row->locality_id == null;
                if ($this->locationType == 'state') {
                    $row->state_id = $this->locationId;
                } else if ($this->locationType == 'city') {
                    $cityRow = City::select(['id', 'state_id'])->find($this->locationId);
                    if (!empty($cityRow)) {
                        $row->state_id = $cityRow->state->id;
                        $row->city_id = $cityRow->id;
                    }
                } else if ($this->locationType == 'locality') {
                    $localityRow = Locality::select(['id', 'state_id', 'city_id'])->find($this->locationId);
                    if (!empty($localityRow)) {
                        $row->state_id = $localityRow->state->id;
                        $row->city_id = $localityRow->city->id;
                        $row->locality_id = $localityRow->id;
                    }
                }
                if ($oldEmail != $this->email) {
                    $row->email = $this->email;
                    $row->email_verified_at = NULL;
                }
                $row->update();
                $this->isSuccess = true;
                if ($oldEmail == $this->email) {
                    $this->getUserProfile();
                    $this->emitTo('shared.header', 'refreshProfile');
                    $this->emitTo('members.profiles.header', 'refreshProfile');
                } else {
                    $row->notify(new VerifyEmail);
                    Auth::logout();
                    return redirect()->route('welcome');
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end update

    public function render()
    {
        return view('livewire.members.profiles.profile-edit');
    }
}
