<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class PostSingle extends Component
{
    public $post;
    public $catRow;
    public $catNav;
    public $parentNavCatId;

    public function mount($post, $catRow, $catNav)
    {
        try {
            $this->post = $post;
            $this->catRow = $catRow;
            $this->catNav = $catNav;
            if (count($this->catNav) > 0) {
                $this->parentNavCatId =  $this->catNav[count($this->catNav) - 1]['id'];
            }
        } catch (\Throwable $th) {
            //throw $th;
          
        }
    }

    public function render()
    {
        return view('livewire.posts.post-single');
    }
}
