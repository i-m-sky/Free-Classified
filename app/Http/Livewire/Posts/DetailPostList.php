<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;

class DetailPostList extends Component
{
    public $currentDate;
    public $post;
    public $catRow;
    public $catNav;

    public function mount($post, $catNav)
    {
        try {
            $this->post = $post;
            $this->catNav = $catNav;
            $this->currentDate = Carbon::now()->format('Y-m-d');
            $catRow = DB::table('categories')->where('id',  $this->post['category_id'])->first();
            if (!empty($catRow)) {
                $this->catRow = collect($catRow)->toArray();
            } else {
                $this->catRow = collect([]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function render()
    {
        $data = [];
        try {
            $selectCotent = ['posts.id', 'posts.name', 'posts.description', 'posts.state_id', 'posts.city_id', 'posts.locality_id', 'posts.price', 'posts.created_at', 'salary_period', 'education_level', 'position_type', 'experience_year', 'salary_from', 'salary_to', 'bedroom', 'bathroom', 'furnishing', 'listed_by', 'super_builtup_area', 'carpet_area', 'is_bachelors_allowed', 'total_floor', 'floor_number', 'car_parking', 'facing', 'plot_area', 'length', 'breadth', 'washroom', 'construction_status', 'is_meal_included', 'registration_year', 'km_driven', 'hp_power', 'transmission', 'body_type', 'vehicle_parts_accessory_type', 'pet_age', 'pet_gender', 'pet_breed', 'pet_colour', 'community_age', 'community_date_from', 'community_date_to', 'condition', 'posts.category_id', 'posts.owner', 'fuel_type', 'image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5'];
            $posts = Post::where('posts.status', 'active')->where('posts.active_date', '>=', $this->currentDate)->whereNotNull('posts.state_id');
            $posts->where('posts.category_id', $this->post['category_id']);
            $posts->whereNotIn('posts.id', [$this->post['id']]);
            $posts->orderBy('posts.created_at', 'desc');
            $posts = $posts->select($selectCotent)->paginate(5);
            $data['posts'] = $posts;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('livewire.posts.detail-post-list', $data);
    }
}
