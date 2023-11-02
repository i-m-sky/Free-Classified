<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FindOutMore extends Component
{
    public $page;
    public $location;
    public $catRow;
    public $catId;
    public $categories = [];
    public $subCategories = [];

    public function mount($page = 'home', $location = 'india', $catRow = '')
    {
        try {
            $this->page = $page;
            $this->location = $location;
            $this->catRow = $catRow;
            $this->currentDate = Carbon::now()->format('Y-m-d');
            if (isset($this->catRow) && !empty($this->catRow) && count($this->catRow) > 0) {
                $catId = $this->catRow['id'];
            } else {
                $catId = 0;
            }

            if ($page == 'list' || $page = 'home') {
                $categories = DB::table('categories as c')
                    ->where('c.parent_id', $catId)
                    ->where('c.status', 'active')
                    ->select('c.slug', 'c.name', 'c.id')
                    ->orderBy('c.name')
                    ->get();

                $this->categories = collect($categories)->map(function ($x) {
                    return (array) $x;
                })->toArray();
                if (count($categories) > 0) {
                    $subCategories = DB::table('categories as c')
                        ->whereIn('c.parent_id', $categories->pluck('id'))
                        ->where('c.status', 'active')
                        ->select('c.slug', 'c.name', 'c.parent_id')
                        ->orderBy('c.name')
                        ->get();
                    $this->subCategories = collect($subCategories)->map(function ($x) {
                        return (array) $x;
                    })->toArray();
                }
            } else {
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {

        return view('livewire.shared.find-out-more');
    }
}
