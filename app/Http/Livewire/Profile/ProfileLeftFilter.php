<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileLeftFilter extends Component
{
    public $user;
    public $currentDate;
    public $category;
    public $catRow;
    public $catNav;
    public $childCategories;

    public function mount($user,  $category, $catRow, $catNav)
    {
        try {
            $this->user = $user;
            $this->category = $category;
            $this->catRow = $catRow;
            $this->catNav = $catNav;
            if ($this->user['id'] != Auth::id()) {
                $this->currentDate = Carbon::now()->format('Y-m-d');
            } else {
                $this->currentDate = '2022-01-01';
            }

            if ($this->category == 'all') {
                $childCategories = DB::table('categories as c')
                    ->where('c.parent_id', 0)
                    ->where('c.status', 'active');
                $childCategories->select('c.id', 'c.slug', 'c.name', DB::raw(" func_getNodePostCountByUserId(c.id, '" . $this->currentDate . "', '" . $this->user['id'] . "')  as total"));
                $childCategories = $childCategories->orderBy('c.name')->get();
            } else {
                $childCategories = DB::table('categories as c')
                    ->where('c.parent_id', $this->catRow['id'])
                    ->where('c.status', 'active');
                $childCategories->select('c.id', 'c.slug', 'c.name', DB::raw(" func_getNodePostCountByUserId(c.id, '" . $this->currentDate . "', '" . $this->user['id'] . "')  as total"))
                    ->orderBy('c.name');
                $childCategories = $childCategories->get();
            }
            $this->childCategories = collect($childCategories)->map(function ($x) {
                return (array) $x;
            })->toArray();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function render()
    {
        return view('livewire.profile.profile-left-filter');
    }
}
