<?php

namespace App\Http\Livewire\Posts\List;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
    private $perpage = 20;
    public $parentNavCatId;
    public $parentVehicleSecondCatId;
    public $orderBy;
    public $minPrice = '';
    public $maxPrice = '';
    public $minSalary = '';
    public $maxSalary =  '';
    public $condition = '';
    public $sPeriod = '';
    public $sPosition = '';
    public $petAge = '';
    public $pGender = '';
    public $minKm = '';
    public $maxKm = '';
    public $minYear = '';
    public $maxYear = '';
    public $fType = '';
    public $transmission = '';
    public $owner = '';
    public $hp = '';
    public $bType = '';
    public $bedroom = '';
    public $bathroom = '';
    public $furnishing = '';
    public $listedBy = '';
    public $constructionStatus = '';
    public $superBuiltupArea = '';
    public $plotArea = '';
    public $bachelorsAllowed = '';
    public $qParamRoute;

    public function mount(Request $request, $locationType, $location, $locRow, $stateRow, $cityRow,  $category, $catRow, $catNav, $search)
    {
        try {
            $this->locationType = $locationType;
            $this->location =  $location;
            $this->locRow = $locRow;
            $this->stateRow = $stateRow;
            $this->cityRow = $cityRow;
            $this->category =  $category;
            $this->catRow = $catRow;
            $this->catNav = $catNav;
            $this->search =  $search;
            $this->orderBy = 'new';
            $this->currentDate = Carbon::now()->format('Y-m-d');
            if (count($this->catNav) > 0) {
                $this->parentNavCatId =  $this->catNav[count($this->catNav) - 1]['id'];
            }
            if ($this->parentNavCatId == 8 && count($this->catNav) >= 2) {
                $this->parentVehicleSecondCatId =  $this->catNav[count($this->catNav) - 2]['id'];
            }

            //Request
            $this->minPrice = (isset($request->minprice) && !empty($request->minprice)) ? urldecode(strtolower($request->minprice)) : '';
            $this->maxPrice = (isset($request->maxprice) && !empty($request->maxprice)) ? urldecode(strtolower($request->maxprice)) : '';

            $this->minSalary = (isset($request->minsalary) && !empty($request->minsalary)) ? urldecode(strtolower($request->minsalary)) : '';
            $this->maxSalary = (isset($request->maxsalary) && !empty($request->maxsalary)) ? urldecode(strtolower($request->maxsalary)) : '';

            $this->condition = (isset($request->condition) && !empty($request->condition)) ? urldecode(strtolower($request->condition)) : '';
            $this->sPeriod = (isset($request->speriod) && !empty($request->speriod)) ? urldecode(strtolower($request->speriod)) : '';
            $this->sPosition = (isset($request->sposition) && !empty($request->sposition)) ? urldecode(strtolower($request->sposition)) : '';
            $this->petAge = (isset($request->petage) && !empty($request->petage)) ? urldecode(strtolower($request->petage)) : '';
            $this->pGender = (isset($request->pgender) && !empty($request->pgender)) ? urldecode(strtolower($request->pgender)) : '';
            $this->minKm = (isset($request->minkm) && !empty($request->minkm)) ? urldecode(strtolower($request->minkm)) : '';
            $this->maxKm = (isset($request->maxkm) && !empty($request->maxkm)) ? urldecode(strtolower($request->maxkm)) : '';
            $this->minYear = (isset($request->minyear) && !empty($request->minyear)) ? urldecode(strtolower($request->minyear)) : '';
            $this->maxYear = (isset($request->maxyear) && !empty($request->maxyear)) ? urldecode(strtolower($request->maxyear)) : '';
            $this->fType = (isset($request->ftype) && !empty($request->ftype)) ? urldecode(strtolower($request->ftype)) : '';
            $this->transmission = (isset($request->transmission) && !empty($request->transmission)) ? urldecode(strtolower($request->transmission)) : '';
            $this->owner = (isset($request->owner) && !empty($request->owner)) ? urldecode(strtolower($request->owner)) : '';
            $this->hp = (isset($request->hp) && !empty($request->hp)) ? urldecode(strtolower($request->hp)) : '';
            $this->bType = (isset($request->btype) && !empty($request->btype)) ? urldecode(strtolower($request->btype)) : '';
            $this->bedroom = (isset($request->bedroom) && !empty($request->bedroom)) ? urldecode(strtolower($request->bedroom)) : '';
            $this->bathroom = (isset($request->bathroom) && !empty($request->bathroom)) ? urldecode(strtolower($request->bathroom)) : '';
            $this->furnishing = (isset($request->furnishing) && !empty($request->furnishing)) ? urldecode(strtolower($request->furnishing)) : '';
            $this->listedBy = (isset($request->listedby) && !empty($request->listedby)) ? urldecode(strtolower($request->listedby)) : '';
            $this->constructionStatus = (isset($request->cstatus) && !empty($request->cstatus)) ? urldecode(strtolower($request->cstatus)) : '';
            $this->superBuiltupArea = (isset($request->sparea) && !empty($request->sparea)) ? urldecode(strtolower($request->sparea)) : '';
            $this->plotArea = (isset($request->parea) && !empty($request->parea)) ? urldecode(strtolower($request->parea)) : '';
            $this->bachelorsAllowed = (isset($request->ballowed) && !empty($request->ballowed)) ? urldecode(strtolower($request->ballowed)) : '';
        } catch (\Throwable $th) {
        }
    } //end mount

    public function removeAllFilterFied()
    {
        try {
            $this->location  = 'india';
            return redirect()->route('post-list', ['location' => $this->location]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end removeAllFilterFied

    public function removeFilterByField($field)
    {
        try {

            if ($field == 'category') {
                $this->category  = 'all';
                if (empty($this->qParamRoute)) {
                    return redirect()->route('post-list', ['location' => $this->location]);
                } else {
                    $this->getParamsUrl();
                    $url =  '/' . $this->location . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '' : '?');
                    return redirect()->to($url);
                }
            } else if ($field == 'location') {
                $this->location  = 'india';
                if (empty($this->qParamRoute)) {
                    if (!empty($this->category)) {
                        return redirect()->route('post-list', ['location' => $this->location, 'category' => $this->category]);
                    } else {
                        return redirect()->route('post-list', ['location' => $this->location]);
                    }
                } else {
                    $this->getParamsUrl();
                    if (!empty($this->category)) {
                        $url =  '/' . $this->location . '/' . $this->category . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '' : '?');
                    } else {
                        $url =  '/' . $this->location . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '' : '?');
                    }
                    return redirect()->to($url);
                }
            } else {

                if ($field == 'minPrice') {
                    $this->minPrice = '';
                } elseif ($field == 'maxPrice') {
                    $this->maxPrice = '';
                } else if ($field == 'minSalary') {
                    $this->minSalary = '';
                } else if ($field == 'maxSalary') {
                    $this->maxSalary = '';
                } else if ($field == 'condition') {
                    $this->condition = '';
                } else if ($field == 'sPeriod') {
                    $this->sPeriod = '';
                } else if ($field == 'sPeriod') {
                    $this->sPeriod = '';
                } else if ($field == 'petAge') {
                    $this->petAge = '';
                } else if ($field == 'pGender') {
                    $this->pGender = '';
                } else if ($field == 'minKm') {
                    $this->minKm = '';
                } else if ($field == 'maxKm') {
                    $this->maxKm = '';
                } else if ($field == 'minYear') {
                    $this->minYear = '';
                } else if ($field == 'maxYear') {
                    $this->maxYear = '';
                } else if ($field == 'fType') {
                    $this->fType = '';
                } else if ($field == 'transmission') {
                    $this->transmission = '';
                } else if ($field == 'owner') {
                    $this->owner = '';
                } else if ($field == 'hp') {
                    $this->hp = '';
                } else if ($field == 'bType') {
                    $this->bType = '';
                } else if ($field == 'bedroom') {
                    $this->bedroom = '';
                } else if ($field == 'bathroom') {
                    $this->bathroom = '';
                } else if ($field == 'furnishing') {
                    $this->furnishing = '';
                } else if ($field == 'listedBy') {
                    $this->listedBy = '';
                } else if ($field == 'constructionStatus') {
                    $this->constructionStatus = '';
                } else if ($field == 'superBuiltupArea') {
                    $this->superBuiltupArea = '';
                } else if ($field == 'plotArea') {
                    $this->plotArea = '';
                } else if ($field == 'bachelorsAllowed') {
                    $this->bachelorsAllowed = '';
                }
                $this->getParamsUrl();
                if (!empty($this->category)) {
                    $url =  '/' . $this->location . '/' . $this->category . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '' : '?');
                } else {
                    $url =  '/' . $this->location . (!empty($this->qParamRoute) ? '?' . $this->qParamRoute . '' : '?');
                }
                return redirect()->to($url);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end removeFilterByField

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
        $data = [];
        try {
            $selectCotent = ['posts.id', 'posts.name', 'posts.description', 'posts.state_id', 'posts.city_id', 'posts.locality_id', 'posts.price', 'posts.created_at', 'salary_period', 'education_level', 'position_type', 'experience_year', 'salary_from', 'salary_to', 'bedroom', 'bathroom', 'furnishing', 'listed_by', 'super_builtup_area', 'carpet_area', 'is_bachelors_allowed', 'total_floor', 'floor_number', 'car_parking', 'facing', 'plot_area', 'length', 'breadth', 'washroom', 'construction_status', 'is_meal_included', 'registration_year', 'km_driven', 'hp_power', 'transmission', 'body_type', 'vehicle_parts_accessory_type', 'pet_age', 'pet_gender', 'pet_breed', 'pet_colour', 'community_age', 'community_date_from', 'community_date_to', 'condition', 'posts.category_id', 'posts.owner', 'fuel_type', 'image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5'];
            $posts = Post::where('posts.status', 'active')->where('posts.active_date', '>=', $this->currentDate)->whereNotNull('posts.state_id');
            if (!empty($this->search)) {
                $posts->where('posts.name', 'like', '' . $this->search . '%');
            }
            if (!empty($this->category) && $this->category != 'all' && count($this->catRow) > 0) {
                if (isset($this->catRow['catNodeIds']) && !empty($this->catRow['catNodeIds'])) {
                    $catIds =  array_map('intval', explode(',', $this->catRow['catNodeIds']));
                    array_push($catIds, $this->catRow['id']);
                    $posts->whereIn('posts.category_id', $catIds);
                } else {
                    $posts->where('posts.category_id', $this->catRow['id']);
                }
            }
            if (!empty($this->locRow) && $this->locRow['id'] != 'all') {
                if (!empty($this->locationType) && $this->locationType == 'state') {
                    $posts->where('posts.state_id', $this->locRow['id']);
                } elseif (!empty($this->locationType) && $this->locationType == 'city') {
                    $posts->where('posts.city_id', $this->locRow['id']);
                } elseif (!empty($this->locationType) && $this->locationType == 'locality') {
                    $posts->where('posts.locality_id', $this->locRow['id']);
                }
            }
            // For Search Text
            if (isset($this->search) && !empty($this->search)) {
                $posts->where(
                    function ($query) {
                        return $query
                            ->where('posts.name', 'LIKE', $this->search . '%')
                            ->orWhere('posts.description', 'LIKE', $this->search . '%');
                    }
                );
            }
            // For minimum & maximum prize
            if (isset($this->minPrice) && !empty($this->minPrice) && isset($this->maxPrice) && !empty($this->maxPrice)) {
                $posts->where('posts.price', '>=', $this->minPrice);
                $posts->where('posts.price', '<=', $this->maxPrice);
            } elseif (isset($this->minPrice) && !empty($this->minPrice)) {
                $posts->where('posts.price', '>=', $this->minPrice);
            } elseif (isset($this->maxPrice) && !empty($this->maxPrice)) {
                $posts->where('posts.price', '<=', $this->maxPrice);
            }
            // For minimum & maximum salary
            if (isset($this->minSalary) && !empty($this->minSalary) && isset($this->maxSalary) && !empty($this->maxSalary)) {
                $posts->where('posts.salary_from', '>=', $this->minSalary);
                $posts->where('posts.salary_to', '<=', $this->maxSalary);
            } elseif (isset($this->minSalary) && !empty($this->minSalary)) {
                $posts->where('posts.salary_from', '>=', $this->minSalary);
            } elseif (isset($this->maxSalary) && !empty($this->maxSalary)) {
                $posts->where('posts.salary_to', '<=', $this->maxSalary);
            }

            // For condition
            if (isset($this->condition) && !empty($this->condition) && $this->condition != 'all') {
                $posts->join('master_conditions as mc', 'mc.id', 'posts.condition')->where('mc.status', 1)->where('mc.name', $this->condition);
            }

            // For salary period
            if (isset($this->sPeriod) && !empty($this->sPeriod) && $this->sPeriod == 'all') {
                $posts->join('master_salary_periods as msp', 'msp.id', 'posts.salary_period')->where('msp.status', 1)->where('msp.name', $this->sPeriod);
            }

            // For salary period
            if (isset($this->sPosition) && !empty($this->sPosition) && $this->sPosition != 'all') {
                $posts->join('master_position_types as mpt', 'mpt.id', 'posts.position_type')->where('mpt.status', 1)->where('mpt.name', $this->sPosition);
            }

            // For pet age
            if (isset($this->petAge) && !empty($this->petAge) && $this->petAge != 'all') {
                $petAge = getPetAgesIds($this->petAge);
                if (count($petAge) > 0) {
                    $posts->join('master_pets_ages as mpa', 'mpa.id', 'posts.pet_age')->where('mpa.status', 1)->whereIn('mpa.id', $petAge);
                }
            }

            // For minimum & maximum kilometer driven
            if (isset($this->minkm) && !empty($this->minkm) && isset($this->maxkm) && !empty($this->maxkm)) {
                $posts->where('posts.km_driven', '>=', $this->minkm);
                $posts->where('posts.km_driven', '<=', $this->maxkm);
            } elseif (isset($this->minkm) && !empty($this->minkm)) {
                $posts->where('posts.km_driven', '>=', $this->minkm);
            } elseif (isset($this->maxkm) && !empty($this->maxkm)) {
                $posts->where('posts.km_driven', '<=', $this->maxkm);
            }

            // For minimum & maximum register year
            if (isset($this->minyear) && !empty($this->minyear) && isset($this->maxyear) && !empty($this->maxyear)) {
                $posts->where('posts.registration_year', '>=', $this->minyear);
                $posts->where('posts.registration_year', '<=', $this->maxyear);
            } elseif (isset($this->minyear) && !empty($this->minyear)) {
                $posts->where('posts.registration_year', '>=', $this->minyear);
            } elseif (isset($this->maxyear) && !empty($this->maxyear)) {
                $posts->where('posts.registration_year', '<=', $this->maxyear);
            }

            // For fuel type
            if (isset($this->ftype) && !empty($this->ftype) && $this->ftype != 'all') {
                $posts->join('master_fuel_types as mft', 'mft.id', 'posts.fuel_type')->where('mft.status', 1)->where('mft.name', $this->ftype);
            }

            // For transmission
            if (isset($this->transmission) && !empty($this->transmission) && $this->transmission != 'all') {
                $posts->join('master_transmissions as mt', 'mt.id', 'posts.transmission')->where('mt.status', 1)->where('mt.name', $this->transmission);
            }

            // For owner
            if (isset($this->owner) && !empty($this->owner) && $this->owner != 'all') {
                $posts->join('master_owners as mo', 'mo.id', 'posts.owner')->where('mo.status', 1)->where('mo.name', $this->owner);
            }

            // For minimum & maximum hp power
            if (isset($this->hp) && !empty($this->hp)) {
                $hpPowerArr = getHPPowersVal($this->hp);
                if (count($hpPowerArr) == 2) {
                    $posts->where('posts.hp_power', '>=', $hpPowerArr[0]);
                    $posts->where('posts.hp_power', '<=', $hpPowerArr[1]);
                }
            }

            // For body type
            if (isset($this->bType) && !empty($this->bType) && $this->bType != 'all') {
                //Vehicles > Buses => 41
                if ($this->parentVehicleSecondCatId == 41) {
                    $posts->join('master_bus_body_types as mbbt', 'mbbt.id', 'posts.body_type')->where('mbbt.status', 1)->where('mbbt.name', $this->bType);
                }
                //Vehicles > Trucks => 42
                if ($this->parentVehicleSecondCatId == 42) {
                    $posts->join('master_truck_body_types as mtbt', 'mtbt.id', 'posts.body_type')->where('mtbt.status', 1)->where('mtbt.name', $this->bType);
                }
            }

            // For Bedroom
            if (isset($this->bedroom) && !empty($this->bedroom) && $this->bedroom != 'all') {
                $posts->where('posts.bedroom', str_replace('-bhk', '', strtolower($this->bedroom)));
            }

            // For Bathroom
            if (isset($this->bathroom) && !empty($this->bathroom) && $this->bathroom != 'all') {
                $posts->where('posts.bathroom', str_replace('-bathroom', '', strtolower($this->bathroom)));
            }

            // For Furnishing
            if (isset($this->furnishing) && !empty($this->furnishing) && $this->furnishing == 'all') {
                $posts->join('master_furnishing as mf', 'mf.id', 'posts.furnishing')->where('mf.status', 1)->where('mf.name', $this->furnishing);
            }

            // For listed by
            if (isset($this->listedBy) && !empty($this->listedBy) && $this->listedBy != 'all') {
                $posts->join('master_listed_by as mlb', 'mlb.id', 'posts.listed_by')->where('mlb.status', 1)->where('mlb.name', $this->listedBy);
            }

            // For construction status
            if (isset($this->constructionStatus) && !empty($this->constructionStatus) && $this->constructionStatus != 'all') {
                $posts->join('master_construction_status as mcs', 'mcs.id', 'posts.owner')->where('mcs.status', 1)->where('mcs.name', $this->constructionStatus);
            }

            // For minimum & maximum super builtup area
            if (isset($this->superBuiltupArea) && !empty($this->superBuiltupArea)) {
                $superBuiltupAreaArr = getSuperBuiltupAreaVal($this->superBuiltupArea);
                if (count($superBuiltupAreaArr) == 2) {
                    $posts->where('posts.super_builtup_area', '>=', $superBuiltupAreaArr[0]);
                    $posts->where('posts.super_builtup_area', '<=', $superBuiltupAreaArr[1]);
                }
            }

            // For minimum & maximum hp power
            if (isset($this->plotArea) && !empty($this->plotArea)) {
                $plotAreaArr = getSuperBuiltupAreaVal($this->plotArea);
                if (count($plotAreaArr) == 2) {
                    $posts->where('posts.plot_area', '>=', $plotAreaArr[0]);
                    $posts->where('posts.plot_area', '<=', $plotAreaArr[1]);
                }
            }


            // For bachelors allowed
            if (isset($this->bachelorsAllowed) && !empty($this->bachelorsAllowed) && $this->bachelorsAllowed != 'all') {
                $bachelorsAllowed = (strtolower($this->bachelorsAllowed) == 'yes') ? 1 : 0;
                $posts->where('posts.is_bachelors_allowed', $bachelorsAllowed);
            }

            if ($this->orderBy == 'new') {
                $posts->orderBy('posts.created_at', 'desc');
            } elseif ($this->orderBy == 'old') {
                $posts->orderBy('posts.created_at', 'asc');
            } elseif ($this->orderBy == 'phigh') {
                $posts->orderBy('posts.price', 'desc');
            } elseif ($this->orderBy == 'plow') {
                $posts->orderBy('posts.price', 'asc');
            }

            $posts = $posts->select($selectCotent)->paginate($this->perpage);
            $data['posts'] = $posts;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('livewire.posts.list.post-component', $data);
    }
}
