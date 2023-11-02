<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class PostList extends Component
{

    public $posts;
    public $catRow;
    public $catNav;

    public function mount($posts, $catRow, $catNav)
    {
        try {
            $this->posts = $posts;
            $this->catRow = $catRow;
            $this->catNav = $catNav;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    
    public function render()
    {
        return view('livewire.profile.post-list');
    }
}
