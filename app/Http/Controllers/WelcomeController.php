<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Content;
use DB;
class WelcomeController extends Controller
{
    public $selectCotent;

    public function __construct()
    {
        $this->selectCotent = ['description', 'h1_title', 'meta_title', 'meta_description', 'meta_keyword', 'meta_card'];
    }

    public function getPrivacyPolicy()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'privacy-policy')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('pages/privacy-policy', $data);
    } //end getPrivacyPolicy

    public function getTermsCondition()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'terms-condition')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('pages/terms-condition', $data);
    } //end getTermsCondition

    public function getCookyPolicy()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'cookies-policy')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('pages/cookies-policy', $data);
    } //end getTermsCondition


}
