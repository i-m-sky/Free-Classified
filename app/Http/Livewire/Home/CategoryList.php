<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CategoryList extends Component
{
    public $categories = [];

    public function mount()
    {
        try {
            $categories = DB::table('categories')->where('parent_id', 0)->where('status', 'active')->select('id', 'name', 'slug', 'image')->get();
            $this->categories  = collect($categories)->map(function ($x) {
                return (array) $x;
            })->toArray();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function render()
    {
        return view('livewire.home.category-list');
    }
}
