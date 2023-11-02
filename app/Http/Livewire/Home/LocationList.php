<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LocationList extends Component
{
    public $states = [];
    public $cities = [];

    public function mount()
    {
        try {
            $currentDate = Carbon::now()->format('Y-m-d');
            $states = DB::table('states as s')
                ->join('posts as p', 's.id', 'p.state_id')
                ->where('s.status', 'active')->where('p.status', 'active')
                ->where('p.active_date', '>=', $currentDate)
                ->select(['s.name', 's.slug'])
                ->groupBy('s.id')->orderBy('s.name', 'asc')->get();
            $this->states  = collect($states)->map(function ($x) {
                return (array) $x;
            })->toArray();
            // DB::enableQueryLog();
            //     $cities = DB::table('cities as c')
            //         ->join('posts as p', 'c.id', 'p.city_id')
            //         ->where('c.status', 'active')->where('p.status', 'active')
            //         ->where('p.active_date', '>=', $currentDate)
            //         ->select(['c.name', 'c.slug', DB::raw("COUNT(p.id) AS total")])
            //         ->groupBy('c.id')->orderBy('total', 'desc')->limit(50)->get();
            //     dd(DB::getQueryLog());
            $cities = DB::select("select * from (select c.name, c.slug, COUNT(p.id) AS total from cities as c inner join posts as p on c.id = p.city_id where c.status = 'active' and p.status ='active' and p.active_date >= '2023-06-03' group by c.id order by total desc limit 50) as t order by t.name");
            $this->cities  = collect($cities)->map(function ($x) {
                return (array) $x;
            })->toArray();
        } catch (\Throwable $th) {
           
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.home.location-list');
    }
}
