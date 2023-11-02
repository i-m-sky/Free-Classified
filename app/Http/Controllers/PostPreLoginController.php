<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use stdClass;

class PostPreLoginController extends Controller
{
    public $selectCotent;
    public $currentDate;

    public function __construct()
    {
        $this->currentDate = Carbon::now()->format('Y-m-d');
    }

    public function getPostLists(Request $request, $location, $category = 'all')
    {
        try {
            $data = [];
            $data['locationType'] = 'country';
            $locRow = new stdClass;
            $locRow->id = 'all';
            $locRow->name = 'India';
            $data['locRow'] = collect($locRow);
            $data['stateRow'] = collect([]);
            $data['cityRow'] = collect([]);
            $location = urldecode($location);
            $category = urldecode($category);
            if ($location !== 'india') {
                $state = DB::table('states')->where('slug', $location)->where('status', 'active')->select(['id', 'name', 'slug'])->first();
                $city = DB::table('cities')->where('slug', $location)->where('status', 'active')->select(['id', 'name', 'slug', 'state_id'])->first();
                $locality = DB::table('localities')->where('slug', $location)->where('status', 'active')->select(['id', 'name', 'slug', 'city_id', 'state_id'])->first();
                if (isset($state) && !empty($state)) {
                    $data['locationType'] = 'state';
                    $data['locRow'] = $state;
                } else  if (isset($city) && !empty($city)) {
                    $data['locationType'] = 'city';
                    $stateRow = DB::table('states')->where('id', $city->state_id)->where('status', 'active')->select(['id', 'name', 'slug'])->first();
                    if (!empty($stateRow)) {
                        $data['stateRow'] = collect($stateRow)->toArray();
                    }
                    $data['locRow'] = $city;
                } else  if (isset($locality) && !empty($locality)) {
                    $data['locationType'] = 'locality';
                    $stateRow = DB::table('states')->where('id', $locality->state_id)->where('status', 'active')->select(['id', 'name', 'slug'])->first();
                    if (!empty($stateRow)) {
                        $data['stateRow'] = collect($stateRow)->toArray();
                    }
                    $cityRow = DB::table('cities')->where('id', $locality->city_id)->where('status', 'active')->select(['id', 'name', 'slug'])->first();
                    if (!empty($cityRow)) {
                        $data['cityRow'] = collect($cityRow)->toArray();
                    }
                    $data['locRow'] = $locality;
                }
            }

            $data['catNavType'] = false;
            $data['catRow'] = new stdClass;
            $data['catNav'] = collect([]);
            if (!empty($category) && $category != 'all') {
                $catRow =  DB::table('categories')->where('slug', $category)->where('status', 'active')->select('id', 'name', 'parent_id', 'slug', 'meta_title', 'meta_description', 'meta_keyword', 'h1_title', DB::raw(" func_getNodeIds(categories.id)  as catNodeIds"))->first();
                if (!empty($catRow)) {
                    $data['catNav'] = getCategoryParentHierarchical($catRow->id);
                    $data['catNavType'] = true;
                    $data['catRow'] = $catRow;
                }
            }

            $data['location'] = $location;
            $data['category'] = $category;
            $data['page'] = 'list';
            $data['search'] = (isset($request->s) && !empty($request->s)) ? urldecode($request->s) : null;

            return view('posts.list', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getPostLists

    public function getUserProfile($userId = null, Request $request)
    {
        try {
            if (empty($userId)) {
                return redirect()->to('/');
            }
            $user = User::where('id', $userId)->where('user_type', 2)->whereNotNull('email_verified_at')->where('status', 'active')->first();
            if (empty($user)) {
                return redirect()->to('/');
            }
            $data = [];
            $data['user'] = $user;
            return view('posts.profile', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getUserProfile

    public function getPostDetails($slug, $id, Request $request)
    {
        try {
            $selectCotent = '*';
            $post = Post::select($selectCotent)->where('id', $id)->whereNotNull('state_id')->first();
            if (empty($post)) {
                return redirect()->route('welcome');
            }
            if (Str::slug($post->name, '-') != $slug) {
                return redirect()->route('welcome');
            }
            if (isset($post) && $post->user_id == Auth::id()) {
            } else {
                if (isset($post) && $post->status != 'active') {
                    //return redirect()->route('welcome');
                }
                if (isset($post) &&  $post->active_date < $this->currentDate) {
                    return redirect()->route('welcome');
                }
                if (isset($post) && !empty($post->deleted_at)) {
                    // return redirect()->route('welcome');
                }
            }
            //user
            $staySafes = DB::table('stay_safes')->where('status', 1)->select('message')->get();
            $data = [];
            $row = [];
            $row['meta_title'] = $post->name;
            $row['meta_description'] = $post->description;
            $row['meta_keyword'] = $post->description;
            DB::table('posts')->where('id', $post->id)->update(['page_view' =>  DB::raw('IFNULL(page_view,0) + 1')]);
            DB::table('post_view_histories')->insert(['post_id' => $post->id, 'visitor' => $request->ip(), 'user_agent' => $request->server('HTTP_USER_AGENT')]);

            $data['row'] = (object) $row;
            $data['post'] = $post;
            $data['user'] = DB::table('users')->where('id', $post->user_id)->first();
            $data['staySafes'] = $staySafes;
            $data['catNav'] = getCategoryParentHierarchical($post->category_id);
            return view('posts.details', $data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end getPostDetails
}
