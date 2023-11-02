<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchPost extends Component
{
    public $categories;
    public $category;
    public $locaton;
    public $locationId;
    public $locationSlug;
    public $locationType;
    public $search;
    public $searchType;

    protected $listeners = ['setSearchLocationPost', 'setSearchCategoryPost'];

    public function mount(Request $request)
    {
        $categories = DB::table('categories')->where('parent_id', 0)->select(['id', 'name', 'slug'])->get();
        $this->categories = collect($categories)->map(function ($x) {
            return (array) $x;
        })->toArray();
        $this->category = 'all';
        $this->locationSlug = 'india';
        if (isset($request) && !empty($request)) {
            if (isset($request->location) && !empty($request->location)) {
                $this->locationSlug = urldecode($request->location);
                if ($this->locationSlug !== 'india') {
                    $state = DB::table('states')->where('slug', $this->locationSlug)->where('status', 'active')->select(['name'])->first();
                    $city = DB::table('cities')->where('slug', $this->locationSlug)->where('status', 'active')->select(['name'])->first();
                    $locality = DB::table('localities')->where('slug', $this->locationSlug)->where('status', 'active')->select(['name'])->first();
                    if (isset($state) && !empty($state)) {
                        $this->locaton = $state->name;
                    } else  if (isset($city) && !empty($city)) {
                        $this->locaton = $city->name;
                    } else  if (isset($locality) && !empty($locality)) {
                        $this->locaton = $locality->name;
                    }
                }
            }
            if (isset($request->category) && !empty($request->category)) {
                $this->category = urldecode($request->category);
            }
            if (isset($request->s) && !empty($request->s)) {
                $this->search = urldecode($request->s);
            }
        }
    }

    public function setSearchLocationPost($id, $name, $slug, $type)
    {
        $this->locaton = $name;
        $this->locationSlug = $slug;
        $this->locationId = $id;
        $this->locationType = $type;
    } //end setLocation

    public function setSearchCategoryPost($name, $slug, $type)
    {
        if ($type == 'category' && $slug != 'all') {
            $this->category = $slug;
            $this->searchType = 'category';
            $this->search = '';
        } else {
            $this->searchType = 'search';
            $this->search = $name;
        }
    } //end setLocation

    public function searchPost()
    {
        $this->locationSlug = isset($this->locationSlug) && !empty($this->locationSlug) ? $this->locationSlug : 'india';
        $url = '';
        if (isset($this->category) && !empty($this->category) && $this->category != 'all') {
            if (isset($this->searchType) && !empty($this->searchType) && $this->searchType == 'search' && isset($this->search) && !empty($this->search)) {
                $url =  route('post-list',  ['location' => $this->locationSlug, 'category' => $this->category]) . '?s=' . $this->search;
            } else {
                $url = route('post-list', ['location' => $this->locationSlug, 'category' => $this->category]);
            }
        } else {
            if (isset($this->searchType) && !empty($this->searchType) && $this->searchType == 'search' && isset($this->search) && !empty($this->search)) {
                $url = route('post-list', ['location' => $this->locationSlug]) . '?s=' . $this->search;
            } else {
                $url = route('post-list', ['location' => $this->locationSlug]);
            }
        }
        return redirect()->to($url);
    }

    public function render()
    {
        return view('livewire.shared.search-post');
    }
}
