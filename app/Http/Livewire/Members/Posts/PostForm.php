<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
//use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\Models\State;
use App\Models\City;
use App\Models\Locality;
use App\Models\Post;
use App\Rules\NotUrl;
use App\Rules\WordRestrict;
use App\Rules\Price;
use App\Rules\CommunityDate;
use App\Rules\RegYear;
use App\Rules\Check5DigitFromAddName;
use Illuminate\Support\Facades\Storage;
use File;

class PostForm extends Component
{
    use WithFileUploads;
    public $mSalaryPeriods = [];
    public $mEducationLevels = [];
    public $mPositionTypes = [];
    public $mExperienceYears = [];
    public $catRow = [];
    public $catNav = [];
    public $catIds = [];
    public $mBedrooms = [];
    public $mBathrooms = [];
    public $mFurnishing = [];
    public $mListedBy = [];
    public $mCarParking = [];
    public $mFacing = [];
    public $mConstructionStatus = [];
    public $mOwners = [];
    public $mFuelTypes = [];
    public $mHpPowers = [];
    public $mTransmissions = [];
    public $mbodyTypes = [];
    public $mvehiclePartsAccessoryTypes = [];
    public $mPetAges = [];
    public $mPetGenders = [];
    public $mCondition = [];

    public $salaryPeriod;
    public $educationLevel;
    public $positionType;
    public $experienceYear;
    public $salaryFrom;
    public $salaryTo;
    public $bedroom;
    public $bathroom;
    public $furnishing;
    public $listedBy;
    public $superBuiltupArea;
    public $carpetArea;
    public $isBachelorsAllowed;
    public $totalFloor;
    public $floorNo;
    public $carParking;
    public $facing;
    public $price;
    public $plotArea;
    public $length;
    public $breadth;
    public $washroom;
    public $constructionStatus;
    public $isMealIncluded;
    public $regYear;
    public $fuelType;
    public $kmDriven;
    public $owner;
    public $hpPower;
    public $transmission;
    public $bodyType;
    public $vehiclePartsAccessoryType;
    public $petAge;
    public $petGender;
    public $petBreed;
    public $petColour;
    public $communityAge;
    public $communityDateFrom;
    public $communityDateTo;
    public $condition;
    public $name;
    public $description;
    public $locaton;
    public $locationId;
    public $locationType;
    public $images = [];
    public $showImages = [];
    public $imgIndex = [];
    public $tempImages = [];
    public $imageNames = [];
    public $phone;
    public $isWhatsApp;
    public $post;
    public $imageError;
    public $counterImg;

    protected $listeners = ['setLocationPost', 'setFromToDate'];

    public function mount($catRow, $catNav, $post)
    {
        try {

            $this->imgIndex = [];
            $this->showImages = [];
            $this->imageError = null;
            $this->counterImg = 0;


            $this->catRow = $catRow;
            $this->catNav = $catNav;
            $this->post = $post;
            $this->catIds = collect($catNav)->pluck('id')->implode('","');

            if (!empty($this->post) && count($this->post) > 0) {

                $this->salaryPeriod = $this->post['salary_period'];
                $this->educationLevel = $this->post['education_level'];
                $this->positionType = $this->post['position_type'];
                $this->experienceYear = $this->post['experience_year'];
                $this->salaryFrom = $this->post['salary_from'];
                $this->salaryTo = $this->post['salary_to'];
                $this->bedroom = $this->post['bedroom'];
                $this->bathroom = $this->post['bathroom'];
                $this->furnishing  = $this->post['furnishing'];
                $this->listedBy  = $this->post['listed_by'];
                $this->superBuiltupArea  = $this->post['super_builtup_area'];
                $this->carpetArea  = $this->post['carpet_area'];
                $this->isBachelorsAllowed  = ($this->post['is_bachelors_allowed'] === null) ? null : (($this->post['is_bachelors_allowed'] == 0) ? 2 : 1);
                $this->totalFloor  = $this->post['total_floor'];
                $this->floorNo  = $this->post['floor_number'];
                $this->carParking = $this->post['car_parking'];
                $this->facing = $this->post['facing'];
                $this->price = $this->post['price'];
                $this->plotArea = $this->post['plot_area'];
                $this->length = $this->post['length'];
                $this->breadth = $this->post['breadth'];
                $this->washroom = $this->post['washroom'];
                $this->constructionStatus = $this->post['construction_status'];
                $this->isMealIncluded = ($this->post['is_meal_included'] === null) ? null : (($this->post['is_meal_included'] == 0) ? 2 : 1);
                $this->regYear = $this->post['registration_year'];
                $this->fuelType = $this->post['fuel_type'];
                $this->kmDriven = $this->post['km_driven'];
                $this->owner = $this->post['owner'];
                $this->hpPower = $this->post['hp_power'];
                $this->transmission = $this->post['transmission'];
                $this->bodyType = $this->post['body_type'];
                $this->vehiclePartsAccessoryType = $this->post['vehicle_parts_accessory_type'];
                $this->petAge = $this->post['pet_age'];
                $this->petGender = $this->post['pet_gender'];
                $this->petBreed = $this->post['pet_breed'];
                $this->petColour = $this->post['pet_colour'];
                $this->communityAge = $this->post['community_age'];
                $this->communityDateFrom = !empty($this->post['community_date_from']) ? Carbon::createFromFormat('Y-m-d', $this->post['community_date_from'])->format('m/d/Y') : null;
                $this->communityDateTo = !empty($this->post['community_date_to']) ? Carbon::createFromFormat('Y-m-d', $this->post['community_date_to'])->format('m/d/Y') : null;
                $this->condition = $this->post['condition'];
                $this->name = $this->post['name'];
                $this->description = $this->post['description'];
                $this->locaton = $this->post['locaton'];
                $this->locationId = $this->post['locationId'];
                $this->locationType = $this->post['locationType'];
                // //  $this->images = [];
                $this->phone = ($this->post['phone'] === null) ? null : (($this->post['phone'] == 0) ? 2 : (($this->post['phone'] == 1 && !empty(Auth::user()->phone_verified_at)) ? 1 : 3));
                $this->isWhatsApp =  ($this->post['isWhatsApp'] === null) ? null : $this->post['isWhatsApp'];
                $this->getDbImages($post);
            }

            //Jobs => 2
            if (in_array($this->catRow['id'], [2])) {
                $mSalaryPeriods = DB::table('master_salary_periods')->where('status', 1)->select('id', 'name')->get();
                $this->mSalaryPeriods =  collect($mSalaryPeriods)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mEducationLevels = DB::table('master_education_levels')->where('status', 1)->select('id', 'name')->get();
                $this->mEducationLevels =  collect($mEducationLevels)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mPositionTypes = DB::table('master_position_types')->where('status', 1)->select('id', 'name')->get();
                $this->mPositionTypes =  collect($mPositionTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mExperienceYears = DB::table('master_experience_years')->where('status', 1)->select('id', 'name')->get();
                $this->mExperienceYears =  collect($mExperienceYears)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property For Rent > Roommates & Rooms for Rent => 22
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            if (in_array($this->catRow['id'], [15, 16, 20, 21, 22, 26, 27])) {
                $mBedrooms = DB::table('master_bedrooms')->where('status', 1)->select('id', 'name')->get();
                $this->mBedrooms =  collect($mBedrooms)->map(function ($x) {
                    return (array) $x;
                })->toArray();

                $mBathrooms = DB::table('master_bathrooms')->where('status', 1)->select('id', 'name')->get();
                $this->mBathrooms =  collect($mBathrooms)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Commercial Space for Sale => 19
            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property For Rent > Roommates & Rooms for Rent => 22
            //Property > Property For Rent > Commercial Space for Rent => 25
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            //Property > Property To Share > Commercial Space for Shared => 28
            //Property > Guest Houses & PG => 29
            if (in_array($this->catRow['id'], [15, 16, 19, 20, 21, 22, 25, 26, 27, 28, 29])) {
                $mFurnishing = DB::table('master_furnishing')->where('status', 1)->select('id', 'name')->get();
                $this->mFurnishing =  collect($mFurnishing)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Land for Sale => 17
            //Property > Property For Sale > Parking for Sale => 18
            //Property > Property For Sale > Commercial Space for Sale => 19
            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property For Rent > Roommates & Rooms for Rent => 22
            //Property > Property For Rent > Parking for Rent => 23
            //Property > Property For Rent > Land for Rent => 24
            //Property > Property For Rent > Commercial Space for Rent => 25
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            //Property > Property To Share > Commercial Space for Shared => 28
            //Property > Guest Houses & PG => 29
            if (in_array($this->catRow['id'], [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29])) {
                $mListedBy = DB::table('master_listed_by')->where('status', 1)->select('id', 'name')->get();
                $this->mListedBy =  collect($mListedBy)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Commercial Space for Sale => 19
            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property For Rent > Commercial Space for Rent => 25
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            //Property > Property To Share > Commercial Space for Shared => 28
            //Property > Guest Houses & PG => 29
            if (in_array($this->catRow['id'], [15, 16, 19, 20, 21, 25, 26, 27, 28, 29])) {
                $mCarParking = DB::table('master_car_parkings')->where('status', 1)->select('id', 'name')->get();
                $this->mCarParking =  collect($mCarParking)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Land for Sale => 17
            //Property > Property For Sale > Parking for Sale => 18
            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property For Rent > Parking for Rent => 23
            //Property > Property For Rent > Land for Rent => 24
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            if (in_array($this->catRow['id'], [15, 16, 17, 18, 20, 21, 23, 24, 26, 27])) {
                $mFacing = DB::table('master_facing')->where('status', 1)->select('id', 'name')->get();
                $this->mFacing =  collect($mFacing)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Commercial Space for Sale => 19
            if (in_array($this->catRow['id'], [15, 16, 19])) {
                $mConstructionStatus = DB::table('master_construction_status')->where('status', 1)->select('id', 'name')->get();
                $this->mConstructionStatus =  collect($mConstructionStatus)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Vehicles > Cars => 36
            //Vehicles > Motorcycles => 37
            //Vehicles > Scooters => 38
            //Vehicles > Tractors => 40
            //Vehicles > Buses => 41
            //Vehicles > Trucks => 42
            if (in_array($this->catRow['id'], [36, 37, 38, 40, 41, 42])) {
                $mFuelTypes = DB::table('master_fuel_types')->where('status', 1)->select('id', 'name')->whereNotIn('id', [5])->get();
                $this->mFuelTypes =  collect($mFuelTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mOwners = DB::table('master_owners')->where('status', 1)->select('id', 'name')->get();
                $this->mOwners =  collect($mOwners)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Bicycles => 39
            if (in_array($this->catRow['id'], [39])) {
                $mFuelTypes = DB::table('master_fuel_types')->where('status', 1)->whereIn('id', [4, 5])->select('id', 'name')->get();
                $this->mFuelTypes =  collect($mFuelTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Vehicles > Tractors => 40
            // if (in_array($this->catRow['id'], [40])) {
            //     $mHpPowers = DB::table('master_hp_powers')->where('status', 1)->select('id', 'name')->get();
            //     $this->mHpPowers =  collect($mHpPowers)->map(function ($x) {
            //         return (array) $x;
            //     })->toArray();
            // }
            //Vehicles > Cars => 36
            //Vehicles > Buses => 41
            //Vehicles > Trucks => 42
            if (in_array($this->catRow['id'], [36, 41, 42])) {
                $mTransmissions = DB::table('master_transmissions')->where('status', 1)->select('id', 'name')->get();
                $this->mTransmissions =  collect($mTransmissions)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Buses => 41
            if (in_array($this->catRow['id'], [41])) {
                $mbodyTypes = DB::table('master_bus_body_types')->where('status', 1)->select('id', 'name')->get();
                $this->mbodyTypes =  collect($mbodyTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Trucks => 42
            if (in_array($this->catRow['id'], [42])) {
                $mbodyTypes = DB::table('master_truck_body_types')->where('status', 1)->select('id', 'name')->get();
                $this->mbodyTypes =  collect($mbodyTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Parts & Accessories=> 43
            if (in_array($this->catRow['id'], [43])) {
                $mvehiclePartsAccessoryTypes = DB::table('master_vehicle_parts_accessory_types')->where('status', 1)->select('id', 'name')->get();
                $this->mvehiclePartsAccessoryTypes =  collect($mvehiclePartsAccessoryTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Pets > Pets for Sale => 30
            if (in_array($this->catRow['id'], [30])) {
                $mPetAges = DB::table('master_pets_ages')->where('status', 1)->select('id', 'name')->get();
                $this->mPetAges =  collect($mPetAges)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mPetGenders = DB::table('master_pets_genders')->where('status', 1)->select('id', 'name')->get();
                $this->mPetGenders =  collect($mPetGenders)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //For Sale > Fashion for Sale => 32
            //For Sale > Mobiles & Tablets => 33
            //For Sale > Furniture => 34
            //For Sale > Electronics & Appliances => 35
            if (in_array($this->catRow['id'], [32, 33, 34, 35])) {
                $mCondition = DB::table('master_conditions')->where('status', 1)->select('id', 'name')->get();
                $this->mCondition =  collect($mCondition)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
        } catch (\Throwable $th) {
            //throw $th;

        }
    } //end mount 

    public function setLocationPost($id, $name, $type)
    {
        $this->locaton = $name;
        $this->locationId = $id;
        $this->locationType = $type;
    } //end setLocation

    public function setFromToDate($type, $date)
    {
        if (!empty($date)) {
            if ($type == 'from') {
                $this->communityDateFrom = $date;
            } else if ($type == 'to') {
                $this->communityDateTo = $date;
            }
        }
    }

    public function formSubmit()
    {
        $rules = [];
        $messages = [];
        $messages['bedroom.required'] = "Bedroom is required.";
        $messages['bathroom.required'] = "Bathroom is required.";
        $messages['furnishing.required'] = "Furnishing is required.";
        $messages['listedBy.required'] = "Listed by is required.";
        $messages['superBuiltupArea.required'] = "Super builtup area is required.";
        $messages['superBuiltupArea.regex'] = "Super builtup area should be numberic and upto 15 digit.";
        $messages['carpetArea.required'] = "Carpet area is required.";
        $messages['carpetArea.regex'] = "Carpet area should be numberic and upto 15 digit.";
        $messages['isBachelorsAllowed.required'] = "Bachelors allowed is required.";
        $messages['totalFloor.required'] = "Total floor is required.";
        $messages['totalFloor.regex'] = "Total floor should be numberic and upto 3 digit.";
        $messages['floorNo.required'] = "Floor number is required.";
        $messages['floorNo.regex'] = "Floor number should be numberic and upto 3 digit.";
        $messages['carParking.required'] = "Car parking is required.";
        $messages['facing.required'] = "Facing is required.";
        $messages['price.required'] = "Price is required.";
        $messages['price.regex'] = "Price should be valid.";
        $messages['plotArea.required'] = "Plot area is required.";
        $messages['plotArea.regex'] = "Plot area should be numberic and upto 15 digit.";
        $messages['length.required'] = "Length is required.";
        $messages['length.regex'] = "Length should be numberic and upto 15 digit.";
        $messages['breadth.required'] = "Breadth is required.";
        $messages['breadth.regex'] = "Breadth should be numberic and upto 15 digit.";
        $messages['washroom.required'] = "Washroom is required.";
        $messages['constructionStatus.required'] = "Construction status is required.";
        $messages['isMealIncluded.required'] = "Meals included is required.";

        $messages['regYear.required'] = "Reg. year is required.";
        $messages['fuelType.required'] = "Fuel type is required.";
        $messages['kmDriven.required'] = "KM driven is required.";
        $messages['kmDriven.regex'] = "KM driven should be numberic and upto 6 digit.";

        $messages['owner.required'] = "No. of owners is required.";
        $messages['hpPower.required'] = "HP power is required.";
        $messages['hpPower.regex'] = "HP power should be numberic and upto 3 digit.";

        $messages['transmission.required'] = "Transmission is required.";
        $messages['bodyType.required'] = "Body type is required.";
        $messages['vehiclePartsAccessoryType.required'] = "Type is required.";



        $messages['salaryPeriod.required'] = "Salary period is required.";
        $messages['educationLevel.required'] = "Education level is required.";
        $messages['positionType.required'] = "Position type is required.";
        $messages['experienceYear.required'] = "Years of experience is required.";
        $messages['salaryFrom.required'] = "Salary from is required.";
        $messages['salaryFrom.regex'] = "Salary from should be numberic and upto 7 digit.";
        $messages['salaryTo.required'] = "Salary to is required.";
        $messages['salaryTo.regex'] = "Salary to should be numberic and upto 7 digit.";
        $messages['salaryTo.gte'] = "Salary to should be greater than or equal to salaray from.";



        $messages['petAge.required'] = "Age is required.";
        $messages['petGender.required'] = "Gender is required.";
        $messages['petBreed.required'] = "Breed is required.";
        $messages['petColour.required'] = "Colour is required.";

        $messages['communityAge.required'] = "Age is required.";
        $messages['communityAge.regex'] = "Age should be numerical  value upto 2 digit.";


        $messages['communityDateFrom.required'] = "From date is required.";
        $messages['communityDateTo.required'] = "To date is required.";

        $messages['condition.required'] = "Condition is required.";


        $messages['name.required'] = "Name is required.";
        $messages['name.min'] = "A minimum length of 10 characters is required. Please edit the field";

        $messages['description.required'] = "Description is required.";
        $messages['description.min'] = "A minimum length of 10 characters is required. Please edit the field.";
        $messages['description.max'] = "A maximum length of 5000 characters is required. Please edit the field.";

        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Roommates & Rooms for Rent => 22
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        if (in_array($this->catRow['id'], [15, 16, 20, 21, 22, 26, 27])) {
            // $rules['bedroom'] = 'required';
            //$rules['bathroom'] = 'required';
        }

        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Roommates & Rooms for Rent => 22
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        //Property > Property To Share > Commercial Space for Shared => 28
        if (in_array($this->catRow['id'], [15, 16, 19, 20, 21, 22, 25, 26, 27, 28])) {
            $rules['superBuiltupArea'] = ['required', 'numeric', 'regex:/^\d{1,15}$/', new Price];
            $rules['carpetArea'] = ['required', 'numeric', 'regex:/^\d{1,15}$/', new Price];
        }


        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Roommates & Rooms for Rent => 22
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        //Property > Property To Share > Commercial Space for Shared => 28
        //Property > Guest Houses & PG => 29
        if (in_array($this->catRow['id'], [15, 16, 19, 20, 21, 22, 25, 26, 27, 28, 29])) {
            //  $rules['furnishing'] = 'required';
        }



        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Land for Sale => 17
        //Property > Property For Sale > Parking for Sale => 18
        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Roommates & Rooms for Rent => 22
        //Property > Property For Rent > Parking for Rent => 23
        //Property > Property For Rent > Land for Rent => 24
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        //Property > Property To Share > Commercial Space for Shared => 28
        //Property > Guest Houses & PG => 29
        if (in_array($this->catRow['id'], [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 28, 29])) {
            //$rules['listedBy'] = 'required';
        }
        // Rent => 5
        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Land for Sale => 17
        //Property > Property For Sale > Parking for Sale => 18
        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Roommates & Rooms for Rent => 22
        //Property > Property For Rent > Parking for Rent => 23
        //Property > Property For Rent > Land for Rent => 24
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        //Property > Property To Share > Commercial Space for Shared => 28
        //Property > Guest Houses & PG => 29
        //Pets > Pets for Sale => 30
        //Pets > Pets Accessories => 31
        //For Sale > Fashion for Sale => 32
        //For Sale > Mobiles & Tablets => 33
        //For Sale > Furniture => 34
        //For Sale > Electronics & Appliances => 35
        //Vehicles > Cars => 36
        //Vehicles > Motorcycles => 37
        //Vehicles > Bicycles => 39
        //Vehicles > Trucks => 40
        //Vehicles > Buses => 41
        //Vehicles > Trucks => 42
        //Vehicles > Parts & Accessories=> 43
        if (in_array($this->catRow['id'], [5, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 39, 40, 41, 42, 43])) {
            $rules['price'] = ['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]; ///^\d{1,15}(\.\d{2})?$/

            //
        }


        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        if (in_array($this->catRow['id'], [20, 21, 26, 27])) {
            //$rules['isBachelorsAllowed'] = 'required';
        }
        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        if (in_array($this->catRow['id'], [15, 16, 20, 21, 26, 27])) {
            $rules['totalFloor'] =  ['nullable', 'numeric', 'regex:/^\d{1,3}$/', new Price];
            $rules['floorNo'] =  ['nullable', 'numeric', 'regex:/^\d{1,3}$/', new Price];
        }
        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        //Property > Property To Share > Commercial Space for Shared => 28
        //Property > Guest Houses & PG => 29
        if (in_array($this->catRow['id'], [15, 16, 19, 20, 21, 25, 26, 27, 28, 29])) {
            // $rules['carParking'] = 'required';
        }

        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Land for Sale => 17
        //Property > Property For Sale > Parking for Sale => 18
        //Property > Property For Rent > Houses for Rent => 20
        //Property > Property For Rent > Flats for Rent => 21
        //Property > Property For Rent > Parking for Rent => 23
        //Property > Property For Rent > Land for Rent => 24
        //Property > Property To Share > Houses for Share => 26
        //Property > Property To Share > Flats for Share => 27
        if (in_array($this->catRow['id'], [15, 16, 17, 18, 20, 21, 23, 24, 26, 27])) {
            //$rules['facing'] = 'required';
        }
        //Property > Property For Sale > Land for Sale => 17
        //Property > Property For Sale > Parking for Sale => 18
        //Property > Property For Rent > Parking for Rent => 23
        //Property > Property For Rent > Land for Rent => 24
        if (in_array($this->catRow['id'], [17, 18, 23, 24])) {
            $rules['plotArea'] = ['required', 'numeric', 'regex:/^\d{1,15}$/', new Price];
            $rules['length'] = ['nullable', 'numeric', 'regex:/^\d{1,15}$/', new Price];
            $rules['breadth'] = ['nullable', 'numeric', 'regex:/^\d{1,15}$/', new Price];
        }

        //Property > Property For Sale > Commercial Space for Sale => 19
        //Property > Property For Rent > Commercial Space for Rent => 25
        //Property > Property To Share > Commercial Space for Shared => 28
        if (in_array($this->catRow['id'], [19, 25, 28])) {
            // $rules['washroom'] = 'required';
        }
        //Property > Guest Houses & PG => 29
        if (in_array($this->catRow['id'], [29])) {
            // $rules['isMealIncluded'] = 'required';
        }
        //Property > Property For Sale > Houses for Sale => 15
        //Property > Property For Sale > Flats for Sale => 16 
        //Property > Property For Sale > Commercial Space for Sale => 19
        if (in_array($this->catRow['id'], [15, 16, 19])) {
            // $rules['constructionStatus'] = 'required';
        }

        //Vehicles > Cars => 36
        //Vehicles > Motorcycles => 37
        //Vehicles > Scooters => 38
        //Vehicles > Tractors => 40
        //Vehicles > Buses => 41
        //Vehicles > Trucks => 42
        if (in_array($this->catRow['id'], [36, 37, 38, 40, 41, 42])) {
            $rules['regYear'] =  ['required', 'numeric', 'regex:/^\d{4,4}$/', new RegYear];

            $rules['owner'] = 'required';
        }
        //Vehicles > Cars => 36
        //Vehicles > Motorcycles => 37
        //Vehicles > Scooters => 38
        //Vehicles > Bicycles => 39
        //Vehicles > Tractors => 40
        //Vehicles > Buses => 41
        //Vehicles > Trucks => 42
        if (in_array($this->catRow['id'], [36, 37, 38, 39, 40, 41, 42])) {
            $rules['fuelType'] = 'required';
            $rules['kmDriven'] =  ['required', 'numeric', 'regex:/^\d{1,6}$/', new Price];
        }

        //Vehicles > Tractors => 40
        if (in_array($this->catRow['id'], [40])) {
            $rules['hpPower'] =  ['nullable', 'numeric', 'regex:/^\d{1,3}$/'];
        }

        //Vehicles > Buses => 41
        //Vehicles > Trucks => 42
        if (in_array($this->catRow['id'], [41, 42])) {
            $rules['transmission'] = 'required';
            //$rules['bodyType'] = 'required';
        }

        //Vehicles > Parts & Accessories=> 43
        if (in_array($this->catRow['id'], [43])) {
            $rules['vehiclePartsAccessoryType'] = 'required';
        }

        //Jobs => 2
        if (in_array($this->catRow['id'], [2])) {
            $rules['salaryPeriod'] = 'required';
            // $rules['educationLevel'] = 'required';
            $rules['positionType'] = 'required';
            // $rules['experienceYear'] = 'required';
            $rules['salaryFrom'] = ['nullable', 'numeric', 'regex:/^\d{1,7}$/', new Price];
            $rules['salaryTo'] =  ['nullable', 'numeric', 'regex:/^\d{1,7}$/', new Price, 'gte:salaryFrom'];
        }

        //Pets > Pets for Sale => 30
        if (in_array($this->catRow['id'], [30])) {
            //  $rules['petAge'] = 'required';
            $rules['petBreed'] = ['required', 'max:30'];
            // $rules['petGender'] = 'required';
            // $rules['petColour'] = 'required';
        }

        //Community > Friendship and Dating => 9
        //Community > Friendship and Dating => 11
        if (in_array($this->catRow['id'], [9, 11])) {
            $rules['communityAge'] = ['required', 'regex:/^\d{1,2}$/', new Price];
        }

        // //Community > Friendship and Dating => 11
        // if (in_array($this->catRow['id'], [10])) {
        //     //$rules['communityAge'] = 'required';
        // }

        //Community > Classes and Tuition => 10
        if (in_array($this->catRow['id'], [10])) {
            $rules['communityDateFrom'] = ['required', 'date_format:m/d/Y', new CommunityDate(1)];
            $rules['communityDateTo'] = ['nullable', 'date_format:m/d/Y', new CommunityDate(2, $this->communityDateFrom)];
        }

        //For Sale > Fashion for Sale => 32
        //For Sale > Mobiles & Tablets => 33
        //For Sale > Furniture => 34
        //For Sale > Electronics & Appliances => 35
        if (in_array($this->catRow['id'], [32, 33, 34, 35])) {
            $rules['condition'] = 'required';
        }

        $rules['name'] = ['required', 'min:10', 'max:70',  new NotUrl,  new WordRestrict, new Check5DigitFromAddName('Title'), 'regex:/^[a-zA-Z-_0-9 ]{10,70}$/'];
        $rules['description'] = ['required', 'min:10', 'max:5000', new NotUrl, new WordRestrict, new Check5DigitFromAddName('Description ')];
        $rules['phone'] = ['required'];

        $rules['locaton'] = ['required', 'min:2'];
        $rules['locationId'] = ['required'];
        $rules['locationId'] = ['required'];

        //Jobs => 2
        if (!in_array($this->catRow['id'], [2])) {
            // $rules["images.*"] = ['nullable', 'image', 'max:5120', 'mimes:jpg,jpeg,png']; //'nullable|image|mimes:jpg,jpeg,png|max:5120',
        }

        $validatedDate = $this->validate($rules, $messages);
        try {


            $inputData = [];
            $inputData['salary_period'] =  !empty($this->salaryPeriod) ? $this->salaryPeriod : null;
            $inputData['education_level'] =  !empty($this->educationLevel) ? $this->educationLevel : null;
            $inputData['position_type'] =  !empty($this->positionType) ? $this->positionType : null;
            $inputData['experience_year'] =  !empty($this->experienceYear) ? $this->experienceYear : null;
            $inputData['salary_from'] =  !empty($this->salaryFrom) ? $this->salaryFrom : null;
            $inputData['salary_to'] =  !empty($this->salaryTo) ? $this->salaryTo : null;
            $inputData['bedroom'] =  !empty($this->bedroom) ? $this->bedroom : null;
            $inputData['bathroom'] =  !empty($this->bathroom) ? $this->bathroom : null;
            $inputData['furnishing'] =  !empty($this->furnishing) ? $this->furnishing : null;
            $inputData['listed_by'] =  !empty($this->listedBy) ? $this->listedBy : null;
            $inputData['super_builtup_area'] =  !empty($this->superBuiltupArea) ? $this->superBuiltupArea : null;
            $inputData['carpet_area'] =  !empty($this->carpetArea) ? $this->carpetArea : null;
            $inputData['is_bachelors_allowed'] =  !empty($this->isBachelorsAllowed) ? ($this->isBachelorsAllowed == 2 ? 0 : 1) : null;
            $inputData['total_floor'] =  !empty($this->totalFloor) ? $this->totalFloor : null;
            $inputData['floor_number'] =  !empty($this->floorNo) ? $this->floorNo : null;
            $inputData['car_parking'] =  !empty($this->carParking) ? $this->carParking : null;
            $inputData['facing'] =  !empty($this->facing) ? $this->facing : null;
            $inputData['price'] =  !empty($this->price) ? $this->price : null;
            $inputData['plot_area'] =  !empty($this->plotArea) ? $this->plotArea : null;
            $inputData['length'] =  !empty($this->length) ? $this->length : null;
            $inputData['breadth'] =  !empty($this->breadth) ? $this->breadth : null;
            $inputData['washroom'] =  !empty($this->washroom) ? $this->washroom : null;
            $inputData['construction_status'] =  !empty($this->constructionStatus) ? $this->constructionStatus : null;
            $inputData['is_meal_included'] =  !empty($this->isMealIncluded) ? ($this->isMealIncluded == 2 ? 0 : 1) : null;
            $inputData['registration_year'] =  !empty($this->regYear) ? $this->regYear : null;
            $inputData['fuel_type'] =  !empty($this->fuelType) ? $this->fuelType : null;
            $inputData['km_driven'] =  !empty($this->kmDriven) ? $this->kmDriven : null;
            $inputData['owner'] =  !empty($this->owner) ? $this->owner : null;
            $inputData['hp_power'] =  !empty($this->hpPower) ? $this->hpPower : null;
            $inputData['transmission'] =  !empty($this->transmission) ? $this->transmission : null;
            $inputData['body_type'] =  !empty($this->bodyType) ? $this->bodyType : null;
            $inputData['vehicle_parts_accessory_type'] =  !empty($this->vehiclePartsAccessoryType) ? $this->vehiclePartsAccessoryType : null;
            $inputData['pet_age'] =  !empty($this->petAge) ? $this->petAge : null;
            $inputData['pet_gender'] =  !empty($this->petGender) ? $this->petGender : null;
            $inputData['pet_breed'] =  !empty($this->petBreed) ? $this->petBreed : null;
            $inputData['pet_colour'] =  !empty($this->petColour) ? $this->petColour : null;
            $inputData['community_age'] =  !empty($this->communityAge) ? $this->communityAge : null;
            $inputData['community_date_from'] =  !empty($this->communityDateFrom) ? Carbon::createFromFormat('m/d/Y', $this->communityDateFrom)->format('Y-m-d') : null;
            $inputData['community_date_to'] =  !empty($this->communityDateTo) ? Carbon::createFromFormat('m/d/Y', $this->communityDateTo)->format('Y-m-d') : null;


            $inputData['condition'] =  !empty($this->condition) ? $this->condition : null;
            $inputData['name'] =  !empty($this->name) ? $this->name : null;
            $inputData['description'] =  (strlen($this->description) > 0) ? nl2br($this->description) : NULL;
            if (!empty(Auth::user()->phone_verified_at)) {
                $inputData['phone'] =  !empty($this->phone) ? ($this->phone == 2 ? 0 : 1) : null;
            } else {
                $inputData['phone'] = 0;
            }
            $inputData['isWhatsApp'] =  !empty($this->isWhatsApp) ? 1 : 0;
            if ($inputData['phone'] == 0) {
                $inputData['isWhatsApp'] = null;
            }
            // if (count($this->images) > 0) {
            //     foreach ($this->images as $key => $img) {
            //         $inputData['image_path_' . ($key + 1)] = $this->imageResize($img, 'image_' > ($key + 1));
            //     }
            // }
            if (!empty($this->post)) {
                Post::where('id', $this->post['id'])->update($inputData);
                $row = Post::find($this->post['id']);
            } else {
                if (!empty($this->showImages) && count($this->showImages) > 0) {
                    foreach ($this->showImages as $key => $img) {
                        $inputData['image_path_' . $key] = $img;
                        $fromListPath = storage_path('/app/public/cms/temp/list/' . $img);
                        $toListPath = storage_path('/app/public/cms/post/list/' . $img);
                        File::move($fromListPath, $toListPath);

                        $fromDetailPath = storage_path('/app/public/cms/temp/detail/' . $img);
                        $toDetailPath = storage_path('/app/public/cms/post/detail/' . $img);
                        File::move($fromDetailPath, $toDetailPath);
                    }
                }

                if ($this->locationType == 'state') {
                    $inputData['state_id'] = $this->locationId;
                } else if ($this->locationType == 'city') {
                    $cityRow = City::select(['id', 'state_id'])->find($this->locationId);
                    if (!empty($cityRow)) {
                        $inputData['state_id'] = $cityRow->state->id;
                        $inputData['city_id'] = $cityRow->id;
                    }
                } else if ($this->locationType == 'locality') {
                    $localityRow = Locality::select(['id', 'state_id', 'city_id'])->find($this->locationId);
                    if (!empty($localityRow)) {
                        $inputData['state_id'] = $localityRow->state->id;
                        $inputData['city_id'] = $localityRow->city->id;
                        $inputData['locality_id'] = $localityRow->id;
                    }
                }
                $inputData['category_id'] = $this->catRow['id'];
                $inputData['user_id'] = Auth::id();
                $inputData['plan'] = 'free';
                $inputData['status'] = 'pending';
                $inputData['active_date'] = Carbon::now()->addDay(config('global_variables.default_pending_post_expiry_days'))->format('Y-m-d');
                $inputData['id'] = getUniqueID(12, 'posts', 'id');
                $row = Post::create($inputData);
            }
            // return redirect()->route('post-detail', ['slug' => Str::slug($row->name, '-'), 'id' => $row->id]);
            return redirect()->route('my-post');
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end formSubmit

    private function getDbImages($post)
    {
        try {
            $this->imgIndex = [];
            $this->showImages = [];
            //$this->imageError = null;
            if (!empty($post['image_path_1'])) {
                $this->showImages[1] = $post['image_path_1'];
                $this->imgIndex[0] = 1;
            }
            if (!empty($post['image_path_2'])) {
                $this->showImages[2] = $post['image_path_2'];
                $this->imgIndex[1] = 2;
            }
            if (!empty($post['image_path_3'])) {
                $this->showImages[3] = $post['image_path_3'];
                $this->imgIndex[2] = 3;
            }
            if (!empty($post['image_path_4'])) {
                $this->showImages[4] = $post['image_path_4'];
                $this->imgIndex[3] = 4;
            }
            if (!empty($post['image_path_5'])) {
                $this->showImages[5] = $post['image_path_5'];
                $this->imgIndex[4] = 5;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function getInsertImages($fileName)
    {
        try {
            $this->counterImg  = $this->counterImg + 1;
            $index = $this->counterImg;
            if (!empty($fileName)) {
                $this->showImages[$index] = $fileName;
                $this->imgIndex[$index - 1] = $index;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function UpdatedImages($value, $key)
    {
        $this->imageError = null;
        $message = [
            'images.*.max' => 'The image must not be greater than 5120 kilobytes.',
            'images.*.mimes' => 'The image only support format jpg,png,jpeg'
        ];
        $this->validate([
            'images.*' => ['image', 'max:5120', 'mimes:jpg,png,jpeg']
            // 1MB Max//['nullable', 'image', 'max:5120', 'mimes:jpg,jpeg,png']; 
        ], $message);
        try {
            if (!empty($this->post) && count($this->post) > 0) {
                if (count($this->images) > 0) {
                    if ((count($this->imgIndex) + count($this->images)) > 5) {
                        $this->imageError =  "You cannot upload more than 5 images.";
                    } else {
                        foreach ($this->images as $key => $photo) {
                            $index = $key + 1;
                            for ($i = 1; $i <= 5; $i++) {
                                if (in_array($i, $this->imgIndex)) {
                                } else {
                                    $index = $i;
                                    $this->imgIndex[$i - 1] = $i;
                                    break;
                                }
                            }
                            $fileName = $this->imageResize($photo, $index, $this->post['id']);
                            if (!empty($fileName)) {
                                $field = 'image_path_' . $index;
                                DB::table('posts')->where('id', $this->post['id'])->update([$field => $fileName, 'status' => 'pending']);
                            }
                        }
                        $postR = DB::table('posts')->where('id', $this->post['id'])->select('image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5')->first();
                        if (!empty($postR)) {
                            $this->getDbImages(collect($postR)->toArray());
                        }
                    }
                }
            } else {
                if (count($this->images) > 0) {
                    if ((count($this->imgIndex) + count($this->images)) > 6) {
                        $this->imageError =  "You cannot upload more than 5 images.";
                    } else {
                        foreach ($this->images as $key => $photo) {
                            $index = $key + 1;
                            for ($i = 1; $i <= 5; $i++) {
                                if (in_array($i, $this->imgIndex)) {
                                } else {
                                    $index = $i;
                                    $this->imgIndex[$i - 1] = $i;
                                    break;
                                }
                            }
                            $fileName = $this->imageResize($photo, $index, null);
                            if (!empty($fileName)) {
                                $this->getInsertImages($fileName);
                            }
                        }
                    }
                }
                //tempImages
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function imageResize($file, $type, $postId = null)
    {
        try {
            if (!empty($postId)) {
                $listSrc = 'public/cms/post/list/';
                $detailSrc = 'public/cms/post/detail/';
            } else {
                $listSrc = 'public/cms/temp/list/';
                $detailSrc = 'public/cms/temp/detail/';
            }
            //$this->showImages 
            $imgName = $file->getClientOriginalName();
            if (in_array($imgName, $this->imageNames)) {
                $this->imageError = "Same image file cannot be upload.";
                return null;
            } else {
                $this->imageNames[$type] = $imgName;
                $extension = 'webp'; //$file->getClientOriginalExtension()
                $fileName =  time() . '-' . $type . '.' . $extension;
                $imgData = getimagesize($file->getRealPath());
                $width = $imgData[0];
                $height = $imgData[1];

                //List Image
                $listImg = Image::make($file->getRealPath())->insert(public_path('img/60x15.png'), 'center')->encode($extension);
                Storage::put($listSrc . $fileName, $listImg->getEncoded());

                //Detail Image 600 340
                if ($width > 600 && $height > 340) {
                    $detailImg = Image::make($file->getRealPath())->resize(600, 340,  function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
                } elseif ($width > 600) {
                    $detailImg = Image::make($file->getRealPath())->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
                } elseif ($height > 340) {
                    $detailImg = Image::make($file->getRealPath())->resize(null, 340,  function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
                } else {
                    $detailImg = Image::make($file->getRealPath())->insert(public_path('img/160x30.png'), 'center')->encode($extension);
                }
                Storage::put($detailSrc . $fileName, $detailImg->getEncoded());

                return $fileName;
            }
        } catch (\Throwable $th) {
            return null;
            //throw $th;
        }
    } //end ImageResize

    public function removeImage($file, $index)
    {
        try {
            if (!empty($this->post) && count($this->post) > 0) {
                Storage::delete('public/cms/post/list/' . $file);
                Storage::delete('public/cms/post/detail/' . $file);
                $field = 'image_path_' . $index;
                DB::table('posts')->where('id', $this->post['id'])->update([$field => null]);
                $postR = DB::table('posts')->where('id', $this->post['id'])->select('image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5')->first();
                if (!empty($postR)) {
                    $this->getDbImages(collect($postR)->toArray());
                }
            } else {
                Storage::delete('public/cms/temp/list/' . $file);
                Storage::delete('public/cms/temp/detail/' . $file);
                $field = 'image_path_' . $index;
                unset($this->showImages[$index]);
                unset($this->imgIndex[$index - 1]);
            }
        } catch (\Throwable $th) {
        }
    }
    public function render()
    {
        return view('livewire.members.posts.post-form');
    }
}
