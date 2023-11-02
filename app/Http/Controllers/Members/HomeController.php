<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Content;

class HomeController extends Controller
{
    public $selectCotent;

    public function __construct()
    {
        $this->selectCotent = ['description', 'h1_title', 'meta_title', 'meta_description', 'meta_keyword', 'meta_card', 'name'];
    }

    public function index()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'dashboard')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }

        $query = "SELECT COUNT(id) as total, SUM(IF(status='active',1,0)) as activePost, SUM(IF(status='pending',1,0)) as pendingPost, SUM(IF(status='inactive',1,0)) as inactivePost, SUM(IF(active_date<CURRENT_DATE,1,0)) as expiredPost FROM `posts` WHERE `user_id`='" . Auth::id() . "' ";
        $data['post'] = DB::select($query);
        $data['row'] = $row;
        return view('members.home', $data);
    } //end index
}
