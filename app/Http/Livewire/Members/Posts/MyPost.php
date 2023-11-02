<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class MyPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // tailwind bootstrap
    public $postStatusArr;
    public $user;
    public $searchTitle;
    public $postStatus;
    protected  $listeners = ['refreshMyPost' => '$refresh'];

    public function mount()
    {
        try {
            $this->postStatusArr = getPostStatus();
            $this->postStatus = 'all';
            $this->user = Auth::user();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function searchByStatus($postStatus)
    {
        try {
            $this->postStatus = $postStatus;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function render()
    {

        $select = ['id', 'name', 'description', 'status', 'price', 'created_at', 'category_id', 'state_id', 'city_id', 'locality_id', 'page_view', 'phone_view', 'whatsApp_view', 'send_email', 'active_date', 'image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5'];
        $searchTitle = '%' . $this->searchTitle . '%';
        $results = Post::select($select)
            ->where('user_id', $this->user->id);

        $results->where(function ($query) use ($searchTitle) {
            $query->orWhere('name', 'LIKE', $searchTitle)
                ->orWhere('description', 'LIKE', $searchTitle);
        });
        if ($this->postStatus == 'active' || $this->postStatus == 'inactive' || $this->postStatus == 'pending') {
            if ($this->postStatus == 'pending') {
                $results->whereIn('status', ['pending', 'nsfw']);
            } else {
                $results->where('status', $this->postStatus);
            }
        }


        $results = $results->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.members.posts.my-post',  ['myPosts' => $results]);
    }
}
