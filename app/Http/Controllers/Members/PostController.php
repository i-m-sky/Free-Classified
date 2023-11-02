<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\Post;

class PostController extends Controller
{
    public $selectCotent;

    public function __construct()
    {
        $this->selectCotent = ['description', 'h1_title', 'meta_title', 'meta_description', 'meta_keyword', 'meta_card', 'name'];
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }
    }

    public function getMyPosts()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'my-ads')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('members.posts.my-post', $data);
    } //end getMyPosts

    public function getMyWallet()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'my-ads')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('members.posts.my-wallet', $data);
    } //end getMyWallet

    public function getMyOrder()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'my-ads')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('members.posts.my-order', $data);
    } //end getMyOrder

    public function postYourAdFormStep1($catSlug = null, $catSlug2 = null, $catSlug3 = null)
    {
        $data = [];
        $row = Content::where('slug', 'post-your-ad')->where('status', 'active')->select($this->selectCotent)->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        $data['catSlug'] = !empty($catSlug) ? urlencode($catSlug) : null;
        $data['catSlug2'] = !empty($catSlug2) ? urlencode($catSlug2) : null;
        $data['catSlug3'] = !empty($catSlug3) ? urlencode($catSlug3) : null;
        return view('members.posts.add-step-1', $data);
    } //end postYourAdFormStep1


    public function postYourAdFormStep2($catSlug, $postId = null)
    {
        if (empty($catSlug)) {
            return redirect()->route('new-post');
        }
        $catRow = DB::table('categories')->where('slug', $catSlug)->where('status', 'active')->select('id', 'name', 'parent_id')->first();
        if (empty($catRow)) {
            return redirect()->route('new-post');
        }
        $post = [];
        if (!empty($postId)) {
            $post = Post::where('id', $postId)->first();
            if (empty($post)) {
                return redirect()->route('my-post');
            }
            if ($post->user_id != Auth::id()) {
            }
            if (!empty($post->locality_id)) {
                $post->locaton = $post->locality->name;
                $post->locationId = $post->locality_id;
                $post->locationType = 'locality';
            } elseif (!empty($post->city_id)) {
                $post->locaton = $post->city->name;
                $post->locationId = $post->city_id;
                $post->locationType = 'city';
            } elseif (!empty($post->state_id)) {
                $post->locaton = $post->state->name;
                $post->locationId = $post->state_id;
                $post->locationType = 'state';
            }
        }
        $data = [];
        $row = Content::where('slug', 'post-your-ad')->where('status', 'active')->select($this->selectCotent)->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        $data['catRow'] = $catRow;
        $data['post'] = $post;
        $data['catNav'] = getCategoryParentHierarchical($catRow->id);
        return view('members.posts.add-step-2', $data);
    } //end postYourAdFormStep2
    
    public function promoteMyAd()
    {
        
        return view('members.posts.promote-ad');
    }

    public function cartPage()
    {
        return view('members.posts.cart-page');
    }
}
