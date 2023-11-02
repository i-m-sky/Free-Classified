<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MainCategory extends Component
{
    public $categories;
    public $catImages = [];
    public $selectedCatId;
    public $catSlug;
    public $catSlug2;
    public $catSlug3;

    public function mount($catSlug, $catSlug2, $catSlug3)
    {
        try {
            $this->catSlug = $catSlug;
            $this->catSlug2 = $catSlug2;
            $this->catSlug3 = $catSlug3;
            $categories = DB::table('categories')->where('parent_id', 0)->where('status', 'active')->select('id', 'name', 'slug', 'image')->get();
            $this->categories  = collect($categories)->map(function ($x) {
                return (array) $x;
            })->toArray();
            // $this->catImages = [1 => 'community.jpg', 2 => 'job.jpg', 3 => 'property.jpg', 4 => 'pet.jpg', 5 => 'property.jpg', 6 => 'sale.jpg', 7 => 'services.jpg', 8 => 'vehicle.jpg'];
            if (!empty($this->catSlug)) {
                $key = array_search($this->catSlug, array_column($this->categories, 'slug'));
                if ($key === false) {
                } else {
                    $this->selectedCatId = isset($this->categories[$key]['id']) ? $this->categories[$key]['id'] : null;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function selectCategory($id)
    {
        try {
            $this->selectedCatId = $id;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end selectCategory

    public function render()
    {
        return view('livewire.members.posts.main-category');
    }
}
