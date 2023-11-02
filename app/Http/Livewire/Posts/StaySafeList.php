<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class StaySafeList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap-stay-safe';
    private $perpage = 1;


    public function render()
    {
        $data = [];
        try {
            $staySafes =  DB::table('stay_safes')->where('status', 1)->select('message');
            $staySafes = $staySafes->select()->paginate($this->perpage);
            $data['staySafes'] = $staySafes;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('livewire.posts.stay-safe-list', $data);
    }
}
