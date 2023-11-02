<?php

namespace App\Http\Livewire\Posts\List;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PostLeftFilter extends Component
{
    public $currentDate;
    public $locationType;
    public $location;
    public $locRow;
    public $stateRow;
    public $cityRow;
    public $category;
    public $catRow;
    public $catNav;
    public $search;
    public $childCategories;
    public $childLocations;
    public $parentNavCatId;
    public $parentPetsForSaleCatId;
    public $parentVehicleSecondCatId;
    public $parentPropertySecondThirdCatId;
    public $minPrice;
    public $maxPrice;
    public $minSalary;
    public $maxSalary;
    public $condition;
    public $sPeriod;
    public $sPosition;
    public $petAge;
    public $pGender;
    public $minKm;
    public $maxKm;
    public $minYear;
    public $maxYear;
    public $fType;
    public $transmission;
    public $owner;
    public $hp;
    public $bType;
    public $bedroom;
    public $bathroom;
    public $furnishing;
    public $listedBy;
    public $constructionStatus;
    public $superBuiltupArea;
    public $plotArea;
    public $bachelorsAllowed;


    public $minSupBuiltUpArea;
    public $maxSupBuiltUpArea;

    public $mCondition = [];
    public $mSalaryPeriods = [];
    public $mPositionTypes = [];
    public $mPetGenders = [];
    public $mPetAges = [];
    public $mFuelTypes = [];
    public $mTransmissions = [];
    public $mbodyTypes = [];
    public $mOwners = [];
    public $mHpPowers = [];
    public $currentRoute;
    public $qParamRoute;

    public $mBedrooms = [];
    public $mBathrooms = [];
    public $mFurnishing = [];
    public $mListedBy = [];
    public $mCarParking = [];
    public $mFacing = [];
    public $mConstructionStatus = [];
    public $superBuiltupAreaRange = [];
    public $plotAreaRange = [];
    public $bachelorsAllowedOption = [];

    public function mount($locationType, $location, $locRow, $stateRow, $cityRow,  $category, $catRow, $catNav, $search, $minPrice, $maxPrice, $minSalary, $maxSalary, $condition, $sPeriod, $sPosition, $petAge, $pGender, $minKm, $maxKm, $minYear, $maxYear, $fType, $transmission, $owner, $hp, $bType, $bedroom, $bathroom, $furnishing, $listedBy, $constructionStatus, $superBuiltupArea, $plotArea, $bachelorsAllowed)
    {
        try {
            $this->locationType = $locationType;
            $this->location =  $location;
            $this->locRow =  $locRow;
            $this->stateRow = $stateRow;
            $this->cityRow = $cityRow;
            $this->category =  $category;
            $this->catRow = $catRow;
            $this->catNav = $catNav;
            $this->search =  $search;
            $this->minPrice =  $minPrice;
            $this->maxPrice =  $maxPrice;
            $this->minSalary = $minSalary;
            $this->maxSalary =  $maxSalary;
            $this->condition = $condition;
            $this->sPeriod = $sPeriod;
            $this->sPosition = $sPosition;
            $this->petAge = $petAge;
            $this->pGender = $pGender;
            $this->minKm = $minKm;
            $this->maxKm = $maxKm;
            $this->minYear = $minYear;
            $this->maxYear = $maxYear;
            $this->fType = $fType;
            $this->transmission = $transmission;
            $this->owner = $owner;
            $this->hp = $hp;
            $this->bType = $bType;
            $this->bedroom = $bedroom;
            $this->bathroom = $bathroom;
            $this->furnishing = $furnishing;
            $this->listedBy = $listedBy;
            $this->constructionStatus = $constructionStatus;
            $this->superBuiltupArea = $superBuiltupArea;
            $this->plotArea = $plotArea;
            $this->bachelorsAllowed = $bachelorsAllowed;

            $this->currentDate = Carbon::now()->format('Y-m-d');
            if (count($this->catNav) > 0) {
                $this->parentNavCatId =  $this->catNav[count($this->catNav) - 1]['id'];
                if ($this->parentNavCatId == 4 && count($this->catNav) >= 2) {
                    $this->parentPetsForSaleCatId =  $this->catNav[count($this->catNav) - 2]['id'];
                }
                if ($this->parentNavCatId == 8 && count($this->catNav) >= 2) {
                    $this->parentVehicleSecondCatId =  $this->catNav[count($this->catNav) - 2]['id'];
                }

                if ($this->parentNavCatId == 3 && count($this->catNav) > 2) {
                    $this->parentPropertySecondThirdCatId =  $this->catNav[count($this->catNav) - 3]['id'];
                } else if ($this->parentNavCatId == 3 && count($this->catNav) == 2) {
                    $this->parentPropertySecondThirdCatId =  $this->catNav[count($this->catNav) - 2]['id'];
                }
            }
            if ($this->category == 'all') {
                $childCategories = DB::table('categories as c')
                    ->where('c.parent_id', 0)
                    ->where('c.status', 'active');
                if (isset($this->minPrice) && !empty($this->minPrice) && isset($this->maxPrice) && !empty($this->maxPrice)) {
                    $childCategories->select('c.slug', 'c.name', DB::raw(" func_getNodePostCount(c.id, '" . $this->currentDate . "')  as total"));
                } elseif (isset($this->minPrice) && !empty($this->minPrice)) {
                    $childCategories->select('c.slug', 'c.name', DB::raw(" func_getNodePostCount(c.id, '" . $this->currentDate . "')  as total"));
                } elseif (isset($this->maxPrice) && !empty($this->maxPrice)) {
                    $childCategories->select('c.slug', 'c.name', DB::raw(" func_getNodePostCount(c.id, '" . $this->currentDate . "')  as total"));
                } else {
                    $childCategories->select('c.slug', 'c.name', DB::raw(" func_getNodePostCount(c.id, '" . $this->currentDate . "')  as total"));
                }

                $childCategories = $childCategories->orderBy('c.name')->get();
            } else {
                $childCategories = DB::table('categories as c')
                    ->where('c.parent_id', $this->catRow['id'])
                    ->where('c.status', 'active');
                $childCategories->select('c.slug', 'c.name', DB::raw(" func_getNodePostCount(c.id, '" . $this->currentDate . "')  as total"))
                    ->orderBy('c.name');
                $childCategories = $childCategories->get();
            }
            $this->childCategories = collect($childCategories)->map(function ($x) {
                return (array) $x;
            })->toArray();
            if (isset($this->catRow['catNodeIds']) && !empty($this->catRow['catNodeIds'])) {
                $catIds =  array_map('intval', explode(',', $this->catRow['catNodeIds']));
                array_push($catIds, $this->catRow['id']);
            } else {
                if (isset($this->catRow) && count($this->catRow) > 0) {
                    $catIds = [$this->catRow['id']];
                } else {
                    $catIds = [];
                }
            }
            if ($this->locationType == 'country') {
                if ($this->category == 'all' || count($catIds) == 0) {
                    $childLocations = DB::table('states as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND state_id=l.id) as total"))
                        ->orderBy('l.name')
                        ->get();
                } else {
                    $childLocations = DB::table('states as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND posts.category_id in (" . implode(',', $catIds) . ") AND state_id=l.id) as total"))
                        ->orderBy('l.name')
                        ->get();
                }
            } elseif ($this->locationType == 'state') {
                if ($this->category == 'all'  || count($catIds) == 0) {
                    $childLocations = DB::table('cities as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND city_id=l.id) as total"))
                        ->where('l.state_id', $this->locRow['id'])
                        ->orderBy('l.name')
                        ->get();
                } else {
                    $childLocations = DB::table('cities as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND posts.category_id in (" . implode(',', $catIds) . ") AND city_id=l.id) as total"))
                        ->where('l.state_id', $this->locRow['id'])
                        ->orderBy('l.name')
                        ->get();
                }
            } elseif ($this->locationType == 'city') {
                if ($this->category == 'all'  || count($catIds) == 0) {
                    $childLocations = DB::table('localities as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND locality_id=l.id) as total"))
                        ->where('l.city_id', $this->locRow['id'])
                        ->orderBy('l.name')
                        ->get();
                } else {
                    $childLocations = DB::table('localities as l')
                        ->where('l.status', 'active')
                        ->select('l.slug', 'l.name', DB::raw(" (SELECT count(id) as total FROM posts WHERE status='active' AND active_date >='" . $this->currentDate . "' AND posts.category_id in (" . implode(',', $catIds) . ") AND locality_id=l.id) as total"))
                        ->where('l.city_id', $this->locRow['id'])
                        ->orderBy('l.name')
                        ->get();
                }
            } elseif ($this->locationType == 'locality') {
                $childLocations = [];
            }

            $this->childLocations = collect($childLocations)->map(function ($x) {
                return (array) $x;
            })->toArray();
            //For Sale => 6
            if (in_array($this->parentNavCatId, [6])) {
                $mCondition = DB::table('master_conditions')->where('status', 1)->select('id', 'name')->get();
                $this->mCondition =  collect($mCondition)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Jobs => 2
            if (in_array($this->parentNavCatId, [2])) {
                $mSalaryPeriods = DB::table('master_salary_periods')->where('status', 1)->select('id', 'name')->get();
                $this->mSalaryPeriods =  collect($mSalaryPeriods)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $mPositionTypes = DB::table('master_position_types')->where('status', 1)->select('id', 'name')->get();
                $this->mPositionTypes =  collect($mPositionTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Pets > Pets for Sale => 30
            if (in_array($this->parentPetsForSaleCatId, [30])) {
                $mPetGenders = DB::table('master_pets_genders')->where('status', 1)->select('id', 'name')->get();
                $this->mPetGenders =  collect($mPetGenders)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                $this->mPetAges = getPetAges();
            }

            //Vehicles > Cars => 36
            //Vehicles > Motorcycles => 37
            //Vehicles > Scooters => 38
            //Vehicles > Tractors => 40
            //Vehicles > Buses => 41
            //Vehicles > Trucks => 42
            if (in_array($this->parentVehicleSecondCatId, [36, 37, 38, 40, 41, 42])) {
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
            if (in_array($this->parentVehicleSecondCatId, [39])) {
                $mFuelTypes = DB::table('master_fuel_types')->where('status', 1)->whereIn('id', [4, 5])->select('id', 'name')->get();
                $this->mFuelTypes =  collect($mFuelTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            //Vehicles > Tractors => 40
            if (in_array($this->parentVehicleSecondCatId, [40])) {
                $this->mHpPowers = getHPPowers();
            }
            //Vehicles > Cars => 36
            //Vehicles > Buses => 41
            //Vehicles > Trucks => 42
            if (in_array($this->parentVehicleSecondCatId, [36, 41, 42])) {
                $mTransmissions = DB::table('master_transmissions')->where('status', 1)->select('id', 'name')->get();
                $this->mTransmissions =  collect($mTransmissions)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Buses => 41
            if (in_array($this->parentVehicleSecondCatId, [41])) {
                $mbodyTypes = DB::table('master_bus_body_types')->where('status', 1)->select('id', 'name')->get();
                $this->mbodyTypes =  collect($mbodyTypes)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Vehicles > Trucks => 42
            if (in_array($this->parentVehicleSecondCatId, [42])) {
                $mbodyTypes = DB::table('master_truck_body_types')->where('status', 1)->select('id', 'name')->get();
                $this->mbodyTypes =  collect($mbodyTypes)->map(function ($x) {
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
            if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 20, 21, 22, 26, 27])) {
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
            if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 19, 20, 21, 22, 25, 26, 27, 28, 29])) {
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
            if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29])) {
                $mListedBy = DB::table('master_listed_by')->where('status', 1)->select('id', 'name')->get();
                $this->mListedBy =  collect($mListedBy)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            if (in_array($this->parentPropertySecondThirdCatId, [100])) {
                $mCarParking = DB::table('master_car_parkings')->where('status', 1)->select('id', 'name')->get();
                $this->mCarParking =  collect($mCarParking)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }

            if (in_array($this->parentPropertySecondThirdCatId, [100])) {
                $mFacing = DB::table('master_facing')->where('status', 1)->select('id', 'name')->get();
                $this->mFacing =  collect($mFacing)->map(function ($x) {
                    return (array) $x;
                })->toArray();
            }
            //Property > Property For Sale > Houses for Sale => 15
            //Property > Property For Sale > Flats for Sale => 16 
            //Property > Property For Sale > Commercial Space for Sale => 19
            if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 19])) {
                $mConstructionStatus = DB::table('master_construction_status')->where('status', 1)->select('id', 'name')->get();
                $this->mConstructionStatus =  collect($mConstructionStatus)->map(function ($x) {
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
            if (in_array($this->parentPropertySecondThirdCatId, [15, 16, 19, 20, 21, 22, 25, 26, 27, 28])) {
                $this->superBuiltupAreaRange = getSuperBuiltupArea();
            }

            //Property > Property For Sale > Land for Sale => 17
            //Property > Property For Sale > Parking for Sale => 18
            //Property > Property For Rent > Parking for Rent => 23
            //Property > Property For Rent > Land for Rent => 24
            if (in_array($this->parentPropertySecondThirdCatId, [17, 18, 23, 24])) {
                $this->plotAreaRange = getSuperBuiltupArea();
            }

            //Property > Property For Rent > Houses for Rent => 20
            //Property > Property For Rent > Flats for Rent => 21
            //Property > Property To Share > Houses for Share => 26
            //Property > Property To Share > Flats for Share => 27
            if (in_array($this->parentPropertySecondThirdCatId, [20, 21, 26, 27])) {
                $this->bachelorsAllowedOption = getBachelorsAllowed();
            }


            $this->getParamsUrl();
            $this->currentRoute = route('post-list', ['location' => $this->location, 'category' => $this->category]) . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '&' : '?');;
        } catch (\Throwable $th) {
        }
    }

    public function filterParams()
    {
        try {
            $this->getParamsUrl();
            $route = route('post-list', ['location' => $this->location, 'category' => $this->category]) . '?' . $this->qParamRoute;
            return   redirect()->to($route);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getParamsUrl()
    {
        try {

            $queryParams = '';
            if (!empty($this->search)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 's=' . $this->search;
            }
            if (!empty($this->minPrice)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'minprice=' . $this->minPrice;
            }
            if (!empty($this->maxPrice)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'maxprice=' . $this->maxPrice;
            }
            if (!empty($this->minSalary)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'minsalary=' . $this->minSalary;
            }
            if (!empty($this->maxSalary)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'maxsalary=' . $this->maxSalary;
            }
            if (!empty($this->condition)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'condition=' . $this->condition;
            }
            if (!empty($this->sPeriod)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'speriod=' . $this->sPeriod;
            }
            if (!empty($this->sPosition)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'sposition=' . $this->sPosition;
            }
            if (!empty($this->petAge)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'petage=' . $this->petAge;
            }
            if (!empty($this->pGender)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'pgender=' . $this->pGender;
            }
            if (!empty($this->minKm)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'minkm=' . $this->minKm;
            }
            if (!empty($this->maxKm)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'maxkm=' . $this->maxKm;
            }

            if (!empty($this->minYear)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'minyear=' . $this->minYear;
            }
            if (!empty($this->maxYear)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'maxyear=' . $this->maxYear;
            }
            if (!empty($this->fType)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'ftype=' . $this->fType;
            }
            if (!empty($this->transmission)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'transmission=' . $this->transmission;
            }
            if (!empty($this->owner)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'owner=' . $this->owner;
            }
            if (!empty($this->hp)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'hp=' . $this->hp;
            }
            if (!empty($this->bType)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'btype=' . $this->bType;
            }
            if (!empty($this->bedroom)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'bedroom=' . $this->bedroom;
            }

            if (!empty($this->bathroom)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'bathroom=' . $this->bathroom;
            }

            if (!empty($this->furnishing)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'furnishing=' . $this->furnishing;
            }

            if (!empty($this->listedBy)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'listedby=' . $this->listedBy;
            }
            if (!empty($this->constructionStatus)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'cstatus=' . $this->constructionStatus;
            }

            if (!empty($this->superBuiltupArea)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'sparea=' . $this->superBuiltupArea;
            }

            if (!empty($this->plotArea)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'parea=' . $this->plotArea;
            }

            if (!empty($this->bachelorsAllowed)) {
                $queryParams .= (strlen($queryParams) > 0) ? '&' : '';
                $queryParams .= 'ballowed=' . $this->bachelorsAllowed;
            }


            $this->qParamRoute = $queryParams;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function render()
    {
        return view('livewire.posts.list.post-left-filter');
    }
}
