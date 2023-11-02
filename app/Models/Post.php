<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'salary_period',
        'education_level',
        'position_type',
        'experience_year',
        'salary_from',
        'salary_to',
        'bedroom',
        'bathroom',
        'furnishing',
        'listed_by',
        'super_builtup_area',
        'carpet_area',
        'is_bachelors_allowed',
        'total_floor',
        'floor_number',
        'car_parking',
        'facing',
        'price',
        'plot_area',
        'length',
        'breadth',
        'washroom',
        'construction_status',
        'is_meal_included',
        'registration_year',
        'km_driven',
        'owner',
        'hp_power',
        'transmission',
        'body_type',
        'vehicle_parts_accessory_type',
        'pet_age',
        'pet_gender',
        'pet_breed',
        'pet_colour',
        'community_age',
        'community_date_from',
        'community_date_to',
        'condition',
        'name',
        'description',
        'status',
        'active_date',
        'plan_start_date',
        'plan_end_date',
        'category_id',
        'state_id',
        'city_id',
        'locality_id',
        'user_id',
        'plan',
        'last_cart_plan',
        'last_order_id',
        'image_path_1',
        'image_path_2',
        'image_path_3',
        'image_path_4',
        'image_path_5',
        'page_view',
        'send_email',
        'phone_view',
        'whatsApp_view',
        'created_by',
        'updated_by',
        'phone',
        'isWhatsApp',
        'id',
        'fuel_type'
    ];


    /*
     * Get the category that post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get the state that locality.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city that locality.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the locality that post
     */
    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    /**
     * Get the user that post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the salary period that post.
     */
    public function salaryPeriod()
    {
        return $this->belongsTo(MasterSalaryPeriod::class, 'salary_period', 'id');
    }

    /**
     * Get the education level that post.
     */
    public function educationLevel()
    {
        return $this->belongsTo(MasterEducationLevel::class, 'education_level', 'id');
    }

    /**
     * Get the position type that post.
     */
    public function positionType()
    {
        return $this->belongsTo(MasterPositionType::class, 'position_type', 'id');
    }

    /**
     * Get the experience year that post.
     */
    public function experienceYear()
    {
        return $this->belongsTo(MasterExperienceYear::class, 'experience_year', 'id');
    }

    /**
     * Get the bedroom that post.
     */
    public function bedroomM()
    {
        return $this->belongsTo(MasterBedroom::class, 'bedroom', 'id');
    }

    /**
     * Get the bathroom that post.
     */
    public function bathroomM()
    {
        return $this->belongsTo(MasterBathroom::class, 'bathroom', 'id');
    }

    /**
     * Get the furnishing that post.
     */
    public function furnishingM()
    {
        return $this->belongsTo(MasterFurnishing::class, 'furnishing', 'id');
    }

    /**
     * Get the listed by that post.
     */
    public function listedByM()
    {
        return $this->belongsTo(MasterListedBy::class, 'listed_by', 'id');
    }

    /**
     * Get the car parking thatpost .
     */
    public function carParkingM()
    {
        return $this->belongsTo(MasterCarParking::class, 'car_parking', 'id');
    }

    /**
     * Get the facing that post.
     */
    public function facingM()
    {
        return $this->belongsTo(MasterFacing::class, 'facing', 'id');
    }

    /**
     * Get the construction status that post.
     */
    public function constructionStatusM()
    {
        return $this->belongsTo(MasterConstructionStatus::class, 'construction_status', 'id');
    }

    /**
     * Get the fuel type that post.
     */
    public function fuelTypeM()
    {
        return $this->belongsTo(MasterFuelType::class,'fuel_type', 'id');
    }

    /**
     * Get the owner that post.
     */
    public function ownerM()
    {
        return $this->belongsTo(MasterOwner::class, 'owner', 'id');
    }

    /**
     * Get the hp power that post.
     */
    public function hpPowerM()
    {
        return $this->belongsTo(MasterHpPower::class, 'hp_power', 'id');
    }

    /**
     * Get the transmission that post.
     */
    public function transmissionM()
    {
        return $this->belongsTo(MasterTransmission::class, 'transmission', 'id');
    }

    /**
     * Get the body type that post.
     */
    public function bodyTypeM()
    {
        return $this->belongsTo(MasterTruckBodyType::class, 'body_type', 'id');
    }

    /**
     * Get the vehicle parts accessory type that post.
     */
    public function vehiclePartsAccessoryTypeM()
    {
        return $this->belongsTo(MasterVehiclePartsAccessoryType::class, 'vehicle_parts_accessory_type', 'id');
    }

    /**
     * Get the pet age that post.
     */
    public function petAgeM()
    {
        return $this->belongsTo(MasterPetsAge::class, 'pet_age', 'id');
    }
    /**
     * Get the pet gender that post.
     */
    public function petGenderM()
    {
        return $this->belongsTo(MasterPetsGender::class, 'pet_gender', 'id');
    }

    /**
     * Get the condition that post.
     */
    public function conditionM()
    {
        return $this->belongsTo(MasterCondition::class, 'condition', 'id');
    }
}
