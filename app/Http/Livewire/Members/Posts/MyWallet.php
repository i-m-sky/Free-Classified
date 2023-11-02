<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class MyWallet extends Component
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

    public function render()
    {
        return view('livewire.members.posts.my-wallet');
    }
}
