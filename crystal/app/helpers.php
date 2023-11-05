<?php

use Illuminate\Support\Facades\DB;


if (!function_exists('getCategoryParentHierarchical')) {
    function getCategoryParentHierarchical($catId, $catParent = [])
    {
        $catRow = DB::table('categories')->where('id', $catId)->where('status', 'active')->select('id', 'name', 'parent_id', 'slug')->first();
        if (!empty($catRow)) {
            $cat = [
                'id' => $catRow->id,
                'name' => $catRow->name,
                'parent_id' => $catRow->parent_id,
                'slug' => $catRow->slug
            ];
            array_push($catParent, $cat);
            return getCategoryParentHierarchical($catRow->parent_id, $catParent);
        } else {
            return $catParent;
        }
    } //end getCategoryParentHierarchical
} //end getCategoryParentHierarchical


if (!function_exists('getCategoryChildHierarchical')) {
    function getCategoryChildHierarchical($catId, $catParent = [])
    {
        $categories = DB::table('categories')->where('parent_id', $catId)->where('status', 'active')->select('id', 'name', 'parent_id', 'slug')->get();
        if (!empty($categories) && count($categories) > 0) {
            foreach ($categories as $catRow) {
                $cat = [
                    'id' => $catRow->id,
                    'name' => $catRow->name,
                    'parent_id' => $catRow->parent_id,
                    'slug' => $catRow->slug
                ];
                array_push($catParent, $cat);
                return getCategoryChildHierarchical($catRow->id, $catParent);
            }
        } else {
            return $catParent;
        }
    } //end getCategoryChildHierarchical
} //end getCategoryChildHierarchical




if (!function_exists('isFormCat')) {
    function isFormCat($catIds)
    {
        $formCatIds = [2, 5, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 39, 40, 41, 42, 43];
        if (count($catIds) > 0) {
            foreach ($catIds as $catId) {
                if (in_array($catId, $formCatIds)) {
                    return true;
                }
            }
        }
        return false;
    } //end isFormCat
} //end isFormCat



function getSettingValue($field)
{
    $row = DB::table('settings')->select($field)->first();
    if (!empty($row)) {
        return $row->$field;
    }
    return NULL;
}

/*
 * Get number/ amount format
 */
if (!function_exists('getMoneyFormat')) {
    function getMoneyFormat($amount, $decimal = 2)
    {
        return number_format($amount, $decimal);
    }
}


/*
 * word restriction
 */
if (!function_exists('getWordRestriction')) {
    function getWordRestriction($word)
    {
        $words = getSettingValue('negative_keyword');
        $wordArr = [];
        if (!empty($words)) {
            $wordArr = explode(',', $words);
        }
        $searchWord = strtolower($word);
        $search = str_replace(array(' '), '', $searchWord);
        if (count($wordArr) > 0) {
            foreach ($wordArr as $w) {
                if (strstr($search, trim($w))) {
                    return false;
                }
            }
        }
        return true;
    }
}



if (!function_exists('getUniqueID')) {
    function getUniqueID($charlength, $tablename, $columnname)
    {
        $string = getToken($charlength);
        $numrows = DB::table($tablename)->where($columnname, $string)->count();
        if ($numrows == 0) {
            return $string;
        }
        if ($numrows > 0) {
            $string1 = getUniqueID($charlength, $tablename, $columnname);
            return $string1;
        }
    }
}


if (!function_exists('getToken')) {
    function getToken($length)
    {
        $token = '';
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
        $codeAlphabet .= '0123456789';
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }
        return $token;
    }
}



if (!function_exists('getPostStatus')) {
    function getPostStatus()
    {
        return [
            'pending' => 'Pending',
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
    }
}


if (!function_exists('checkSexaulImage')) {
    function checkSexaulImage($image)
    {
        try {
            $MODE = config('global_variables.nsfw_mode');
            // Your RapidAPI key. Fill this variable with the proper value if you want
            // to try api4ai via RapidAPI marketplace.
            $RAPIDAPI_KEY = config('global_variables.nsfw_api_key');
            $OPTIONS = [
                'demo' => [
                    'url' => 'https://demo.api4ai.cloud/nsfw/v1/results',
                    'headers' => ['A4A-CLIENT-APP-ID: sample']
                ],
                'rapidapi' => [
                    'url' => 'https://nsfw3.p.rapidapi.com/v1/results',
                    'headers' => ["X-RapidAPI-Key: {$RAPIDAPI_KEY}"]
                ]
            ];

            // Initialize request session.
            $request = curl_init();

            $filepath = config('global_variables.image_upload_path') . '/public/cms/post/list' . '/' . $image;
            $data = ['image' =>  new CURLFile($filepath, null, $image)];


            // Set request options.
            curl_setopt($request, CURLOPT_URL, $OPTIONS[$MODE]['url']);
            curl_setopt($request, CURLOPT_HTTPHEADER, $OPTIONS[$MODE]['headers']);
            curl_setopt($request, CURLOPT_POST, true);
            curl_setopt($request, CURLOPT_POSTFIELDS, $data);
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

            // Execute request.
            $result = curl_exec($request);

            // Decode response.
            $raw_response = json_decode($result, true);
            $status = 0;
            if (!empty($raw_response) && count($raw_response) > 0) {
                if (isset($raw_response['results']) && count($raw_response['results']) > 0) {
                    if (isset($raw_response['results'][0]['status']) && count($raw_response['results'][0]['status']) > 0) {
                        if (
                            isset($raw_response['results'][0]['status']['code']) &&   strtolower($raw_response['results'][0]['status']['code']) == 'ok' &&
                            isset($raw_response['results'][0]['status']['message']) &&   strtolower($raw_response['results'][0]['status']['message']) == 'success'
                        ) {
                            if (isset($raw_response['results'][0]['entities']) && count($raw_response['results'][0]['entities']) > 0) {
                                if (isset($raw_response['results'][0]['entities'][0]['classes']) && count($raw_response['results'][0]['entities'][0]['classes']) > 0) {
                                    if (isset($raw_response['results'][0]['entities'][0]['classes']['nsfw']) && isset($raw_response['results'][0]['entities'][0]['classes']['sfw'])) {
                                        $nsfw = $raw_response['results'][0]['entities'][0]['classes']['nsfw'];
                                        $sfw = $raw_response['results'][0]['entities'][0]['classes']['sfw'];
                                        $nsfw_percentage = intval(($nsfw / 1) * 100);
                                        if ($nsfw_percentage > config('global_variables.nsfw_percentage')) {
                                            $status = 1;
                                        }
                                        // echo  "nsfw=" . $nsfw . "<br />";
                                        // echo  "sfw=" . $sfw . "<br />";
                                        // $status = true;
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $status = 1;
                DB::table('service_log')->insert(['title' => 'helper:checkSexaulImage', 'description' => "Response empty or not success"]);
            }
            return $status;
        } catch (\Throwable $th) {
            DB::table('service_log')->insert(['title' => 'helper:checkSexaulImage', 'description' => $th->getMessage()]);
        }
    }
}//end checkSexaulImage