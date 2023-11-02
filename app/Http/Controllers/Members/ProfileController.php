<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Content;
use Image;

class ProfileController extends Controller
{
    public $selectCotent;

    public function __construct()
    {
        $this->selectCotent = ['description', 'h1_title', 'meta_title', 'meta_description', 'meta_keyword', 'meta_card', 'name'];
    }

    public function index()
    {
        $data = [];
        $row = Content::select($this->selectCotent)->where('slug', 'my-profile')->where('status', 'active')->first();
        if (empty($row)) {
            return redirect()->route('welcome');
        }
        $data['row'] = $row;
        return view('members.profile', $data);
    } //end index

    public function uploadUserProfileImage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => '']);
        }
        $userId = Auth::id();
        $validationRule = [];
        $validationRule['image'] = ['nullable', 'image', 'mimes:jpg,png', 'max:2048'];
        $message = [];
        $message['image.required'] = "Image is required.";
        $message['image.string'] = "Image should be image type.";
        $message['image.mimes'] = "Image should be jpg and png format.";
        $message['image.max'] = "Image should be less than equal to 2MB.";
        $request->validate($validationRule, $message);
        $file = $request->image;
        if (isset($file) && !empty($file)) {
            try {
                $oldImage = Auth::user()->photo;
                $extension = 'webp'; //$file->getClientOriginalExtension();
                $img = Image::make($file)->fit(100, 100)->encode($extension); //->fit(200, 200)
                // $img->circle(100, 50, 50, function ($draw) {
                //    // $draw->background('#0000ff');
                // });

                $document_application_name = $userId . '_' . time() . '.' . $extension;
                Storage::put('public/cms/userprofile/' . $document_application_name, $img->getEncoded());
                // $img->move(public_path('public/cms/userprofile/' . $document_application_name'), $myimage);
                DB::table('users')
                    ->where('id', $userId)
                    ->update([
                        'photo' => $document_application_name,
                    ]);
                Storage::delete('public/cms/userprofile/' . $oldImage);
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false]);
            }
        }
    }

    public function removeUserProfileImage(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['success' => false, 'message' => '']);
    }
    $userId = Auth::id();
    $oldImage = Auth::user()->photo;
    try {
        Storage::delete('public/cms/userprofile/' . $oldImage);
        DB::table('users')
            ->where('id', $userId)
            ->update([
                'photo' => null,
            ]);
        //return response()->json(['success' => true]);
        return redirect()->to('/my-profile');
    } catch (\Exception $e) {
        return response()->json(['success' => false]);
        
    }
    
}
}
