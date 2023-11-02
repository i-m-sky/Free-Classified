<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ProfileComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user;
    public $currentDate;
    private $perpage = 10;
    public $orderBy;
    public $category;
    public $catNav;
    public $catRow;
    public $parentNavCatId;
    protected $listeners = ['changeCategory'];

    public function mount($user)
    {
        try {
            $this->user = $user;
            $this->orderBy = 'new';
            $this->currentDate = Carbon::now()->format('Y-m-d');
            $this->catRow = collect([])->toArray();
            $this->catNav = collect([])->toArray();
            $this->category = 'all';
        } catch (\Throwable $th) {
        }
    }

    public function changeCategory($category)
    {
        try {
            $this->resetPage();
            $this->category = $category;
            if ($category != 'all') {
                $catRow  =  DB::table('categories')->where('id', $category)->where('status', 'active')->select('id', 'name', 'parent_id', 'slug', DB::raw(" func_getNodePostCountByUserId(categories.id, '" . $this->currentDate . "', '" . $this->user['id'] . "')  as total"), DB::raw(" func_getNodeIds(categories.id)  as catNodeIds"))->first();
                if (!empty($catRow)) {
                    $this->catRow = collect($catRow)->toArray();
                    $this->catNav =  getCategoryParentHierarchical($catRow->id);
                } else {
                    $this->catRow = collect([])->toArray();
                    $this->catNav = collect([])->toArray();
                }
            } else {
                $this->catRow = collect([])->toArray();
                $this->catNav = collect([])->toArray();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end changeCategory


    public function updatingOrderBy()
    {
        $this->resetPage();
    }


    public function render()
    {
        $data = [];
        try {
            if (count($this->catNav) > 0) {
                $this->parentNavCatId =  $this->catNav[count($this->catNav) - 1]['id'];
            }
            //DB::connection()->enableQueryLog();
            $selectCotent = ['posts.id', 'posts.name', 'posts.description', 'posts.state_id', 'posts.city_id', 'posts.locality_id', 'posts.price', 'posts.created_at', 'salary_period', 'education_level', 'position_type', 'experience_year', 'salary_from', 'salary_to', 'bedroom', 'bathroom', 'furnishing', 'listed_by', 'super_builtup_area', 'carpet_area', 'is_bachelors_allowed', 'total_floor', 'floor_number', 'car_parking', 'facing', 'plot_area', 'length', 'breadth', 'washroom', 'construction_status', 'is_meal_included', 'registration_year', 'km_driven', 'hp_power', 'transmission', 'body_type', 'vehicle_parts_accessory_type', 'pet_age', 'pet_gender', 'pet_breed', 'pet_colour', 'community_age', 'community_date_from', 'community_date_to', 'condition', 'posts.category_id', 'posts.owner', 'fuel_type'];
            $posts = Post::whereNotNull('posts.state_id');

            if (!empty($this->category) && $this->category != 'all' && count($this->catRow) > 0) {
                if (isset($this->catRow['catNodeIds']) && !empty($this->catRow['catNodeIds'])) {
                    $catIds =  array_map('intval', explode(',', $this->catRow['catNodeIds']));
                    array_push($catIds, $this->catRow['id']);
                    $posts->whereIn('posts.category_id', $catIds);
                } else {
                    $posts->where('posts.category_id', $this->catRow['id']);
                }
            }
            if ($this->user['id'] != Auth::id()) {
                $posts->where('posts.status', 'active')->where('posts.active_date', '>=', $this->currentDate);
            }
            $posts->where('posts.user_id', $this->user['id']);
            if ($this->orderBy == 'new') {
                $posts->orderBy('posts.created_at', 'desc');
            } elseif ($this->orderBy == 'old') {
                $posts->orderBy('posts.created_at', 'asc');
            } elseif ($this->orderBy == 'phigh') {
                $posts->orderBy('posts.price', 'asc');
            } elseif ($this->orderBy == 'plow') {
                $posts->orderBy('posts.price', 'desc');
            }
            $posts = $posts->select($selectCotent)->paginate($this->perpage);
            //Log::info(DB::getQueryLog());
            $data['posts'] = $posts;
        } catch (\Throwable $th) {
            $data['posts'] =  collect([]);
        }
        return view('livewire.profile.profile-component', $data);
    }
}
