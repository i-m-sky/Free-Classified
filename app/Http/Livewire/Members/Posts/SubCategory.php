<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SubCategory extends Component
{
    public $selectedCatId;
    public $selectedChildCatId;
    public $mainCategories;
    public $childCategories = [];
    public $catSlug2;
    public $catSlug3;

    public function mount($selectedCatId, $catSlug2 = null, $catSlug3 = null)
    {
        try {
            $this->selectedCatId = $selectedCatId;
            $this->catSlug2 = $catSlug2;
            $this->catSlug3 = $catSlug3;

            $mainCategories = DB::table('categories')->where('parent_id', $this->selectedCatId)->where('status', 'active')->select('id', 'name', 'slug')->orderBy('name', 'asc')->get();
            $this->mainCategories  = collect($mainCategories)->map(function ($x) {
                return (array) $x;
            })->toArray();
            if (count($mainCategories) == 0) {
                $this->selectedChildCatId = $selectedCatId;
            }
            if (!empty($this->catSlug2) && empty($this->selectedChildCatId)) {
                $key = array_search($this->catSlug2, array_column($this->mainCategories, 'slug'));
                if ($key === false) {
                } else {
                    $this->selectedChildCatId = isset($this->mainCategories[$key]['id']) ? $this->mainCategories[$key]['id'] : null;
                }
            }
            if (!empty($this->catSlug3) && empty($this->selectedChildCatId)) {
                $key = array_search($this->catSlug3, array_column($this->mainCategories, 'slug'));
                if ($key === false) {
                } else {
                    $this->selectedChildCatId = isset($this->mainCategories[$key]['id']) ? $this->mainCategories[$key]['id'] : null;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function selectCategory($id)
    {
        try {
            $this->selectedChildCatId = $id;
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end selectCategory

    public function nextStep($id)
    {
        try {
            $catRow = DB::table('categories')->where('id', $id)->where('status', 'active')->select('id', 'slug')->first();
            if (!empty($catRow)) {
                return redirect()->route('new-post-step-2', $catRow->slug);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end nextStep

    public function render()
    {
        if (isset($this->selectedChildCatId) && !empty($this->selectedChildCatId)) {
            $childCategories = DB::table('categories')->where('parent_id', $this->selectedChildCatId)->where('status', 'active')->select('id', 'name')->get();
            $this->childCategories  = collect($childCategories)->map(function ($x) {
                return (array) $x;
            })->toArray();
        }
        return view('livewire.members.posts.sub-category');
    }
}
