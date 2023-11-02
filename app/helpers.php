<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            'inactive' => 'Inactive',
            'nsfw' =>  'Pending',
        ];
    }
}


if (!function_exists('getPetAges')) {
    function getPetAges()
    {
        return [
            '0-8-weeks' => '0-8 weeks',
            '2-6-months' => '2-6 months',
            '6-12-months' => '6-12 months',
            '1-2-years' => '1-2 years',
            '2-4-years' => '2-4 years',
            '4-6-years' => '4-6 years',
            '6+years' => '6+ years '
        ];
    }
}

if (!function_exists('getPetAgesIds')) {
    function getPetAgesIds($key)
    {
        switch ($key) {
            case '0-8-weeks':
                return [1, 2, 3, 4, 5, 6];
                break;
            case '2-6-months':
                return [6, 7, 8, 9, 10];
                break;
            case '6-12-months':
                return [10, 11, 12, 13, 14, 15, 16];
                break;
            case '1-2-years':
                return [16, 17];
                break;
            case '2-4-years':
                return [17, 18, 19];
                break;
            case '4-6-years':
                return [19, 20, 21];
                break;
            case '6+years':
                return [22, 23, 24, 25];
                break;
            default:
                return [];
                break;
        }
    }
}

if (!function_exists('getHPPowers')) {
    function getHPPowers()
    {
        return [
            '1-20-hp' => '1 - 20 HP',
            '21-30-hp' => '21 - 30 HP',
            '31-40-hp' => '31 - 40 HP',
            '41-50-hp' => '41 - 50 HP',
            '51-70-hp' => '51 - 70 HP',
            '71-150-hp' => '71 - 150 HP',
        ];
    }
}

if (!function_exists('getHPPowersVal')) {
    function getHPPowersVal($value)
    {
        switch ($value) {
            case '1-20-hp':
                return [1, 20];
                break;

            case '21-30-hp':
                return [21, 30];
                break;

            case '31-40-hp':
                return [31, 40];
                break;

            case '41-50-hp':
                return [41, 50];
                break;

            case '51-70-hp':
                return [51, 70];
                break;

            case '71-150-hp':
                return [71, 150];
                break;

            default:
                return [];
                break;
        }
    }
}

if (!function_exists('getSuperBuiltupArea')) {
    function getSuperBuiltupArea()
    {
        return [
            '0-50-sq-feet' => '0 - 50 Sq. Feet',
            '501-1250-sq-feet' => '501 - 1250 Sq. Feet',
            '1251-2000-sq-feet' => '1251 - 2000 Sq. Feet',
            '2001-3000-sq-feet' => '2001 - 3000 Sq. Feet',
            '3001-5000-sq-feet' => '3001 - 5000 Sq. Feet',
            'more-than-5000-sq-feet' => 'More than 5000 Sq. Feet',
        ];
    }
}


if (!function_exists('getSuperBuiltupAreaVal')) {
    function getSuperBuiltupAreaVal($value)
    {
        switch ($value) {
            case '0-50-sq-feet':
                return [0, 50];
                break;
            case '501-1250-sq-feet':
                return [501, 1250];
                break;
            case '1251-2000-sq-feet':
                return [1251, 2000];
                break;
            case '2001-3000-sq-feet':
                return [2001, 3000];
                break;
            case '3001-5000-sq-feet':
                return [3001, 5000];
                break;
            case 'more-than-5000-sq-feet':
                return [5001, 1000000];
                break;
            default:
                return [];
                break;
        }
    }
}


if (!function_exists('getBachelorsAllowed')) {
    function getBachelorsAllowed()
    {
        return [
            'no' => 'No',
            'yes' => 'Yes',
        ];
    }
}

if (!function_exists('generateQueryParam')) {
    function generateQueryParam($value)
    {
        return urlencode(strtolower(str_replace(' ', '-', $value)));
    }
}

if (!function_exists('getCategoryTitle')) {
    function getCategoryTitle($type, $locationType, $location, $locRow, $stateRow, $cityRow, $category, $catRow, $catNav, $search, $minPrice, $maxPrice, $minSalary, $maxSalary, $condition, $sPeriod, $sPosition, $petAge, $pGender, $minKm, $maxKm, $minYear, $maxYear, $fType, $transmission, $owner, $hp, $bType, $bedroom, $bathroom, $furnishing, $listedBy, $constructionStatus, $superBuiltupArea, $plotArea, $bachelorsAllowed)
    {

        if ($type == 'meta') {
            if ($category == 'all') {
                $title = 'All Categories in ' . ucwords($locRow['name']);
            } else {
                $title =  isset($catRow) &&  !empty($catRow) && isset($catRow['meta_title']) ? $catRow['meta_title'] : '';
            }
        } else if ($type == 'h1') {
            if ($category == 'all') {
                $title = 'All Categories in ' . ucwords($locRow['name']);
            } else {
                $title =  isset($catRow) &&  !empty($catRow) && isset($catRow['h1_title']) ? $catRow['h1_title'] : '';
            }
        }

        /*
        @search => Search Text
        @location => Location
        @minprice => Minimum Price
        @maxPrice => Maximum Price
        @minsalary => Minimum Salary
        @maxSalary => Maximum Salary
        @condition => Condition
        @sPeriod => Salary Period
        @sPosition => Salary Position 
        @petAge => Pet Age
        @pGender => Pet Gender
        @minKm => Minimum Kilometer
        @maxKm => Maximum Kilometer
        @minYear => Minimum Year
        @maxYear => Maximum Year
        @fType => Fuel Type
        @transmission => Transmission 
        @owner => Owner
        @hp => HP Power
        @bType => Body Type
        @bedroom => Bedroom
        @bathroom => Bathroom
        @furnishing => Furnishing 
        @listedBy => Listed By 
        @constructionStatus => Construction Statu
        @superBuiltupArea => Super Builtup Area
        @plotArea => Plot Area
        @bachelorsAllowed => Bachelors Allowed
        */
        $keysArr = ['@search', '@location', '@minprice', '@maxPrice', '@minsalary', '@maxSalary', '@condition', '@sPeriod', '@sPosition', '@petAge', '@pGender', ' @minKm', '@maxKm', '@minYear', '@maxYear', '@fType', '@transmission', '@owner', '@hp', '@bType', '@bedroom', '@bathroom', '@furnishing', '@listedBy', '@constructionStatus', '@superBuiltupArea', '@plotArea', '@bachelorsAllowed'];

        if (!empty($minPrice) && !empty($maxPrice)) {
            $minPrice = 'Between ' . $minPrice;
            $maxPrice = 'to ' . $maxPrice;
        } elseif (!empty($minPrice)) {
            $minPrice = 'Above ' . $minPrice;
        } elseif (!empty($maxPrice)) {
            $maxPrice = 'Under ' . $maxPrice;
        }

        if (!empty($minYear) && !empty($maxYear)) {
            $minYear = 'Between ' . $minYear;
            $maxYear = 'to ' . $maxYear;
        } elseif (!empty($minYear)) {
            $minYear =   $minYear . ' Model';
        } elseif (!empty($maxYear)) {
            $maxYear = $maxYear . ' Model';
        }

        if (!empty($listedBy) && !empty($listedBy)) {
            $listedBy = 'by ' . ucwords($listedBy);
        }



        $valuesArr = [
            !empty($search) ? $search : NULL,
            !empty($location) ? ucwords(str_replace('-', ' ', $location)) : NULL,
            !empty($minPrice) ? ucwords(str_replace('-', ' ', $minPrice)) : NULL,
            !empty($maxPrice) ? ucwords(str_replace('-', ' ', $maxPrice)) : NULL,
            !empty($minSalary) ? ucwords(str_replace('-', ' ', $minSalary)) : NULL,
            !empty($maxSalary) ? ucwords(str_replace('-', ' ', $maxSalary)) : NULL,
            !empty($condition) ? ucwords(str_replace('-', ' ', $condition)) : NULL,
            !empty($sPeriod) ? ucwords(str_replace('-', ' ', $sPeriod)) : NULL,
            !empty($sPosition) ? ucwords(str_replace('-', ' ', $sPosition)) : NULL,
            !empty($petAge) ? ucwords(str_replace('-', ' ', $petAge)) : NULL,
            !empty($pGender) ? ucwords(str_replace('-', ' ', $pGender)) : NULL,
            !empty($minKm) ? ucwords(str_replace('-', ' ', $minKm)) : NULL,
            !empty($maxKm) ? ucwords(str_replace('-', ' ', $maxKm)) : NULL,
            !empty($minYear) ? ucwords(str_replace('-', ' ', $minYear)) : NULL,
            !empty($maxYear) ? ucwords(str_replace('-', ' ', $maxYear)) : NULL,
            !empty($fType) ? ucwords(str_replace('-', ' ', $fType)) : NULL,
            !empty($transmission) ? ucwords(str_replace('-', ' ', $transmission)) : NULL,
            !empty($owner) ? ucwords(str_replace('-', ' ', $owner)) : NULL,
            !empty($hp) ? ucwords(str_replace('-', ' ', $hp)) : NULL,
            !empty($bType) ? ucwords(str_replace('-', ' ', $bType)) : NULL,
            !empty($bedroom) ? ucwords(str_replace('-', ' ', $bedroom)) : NULL,
            !empty($bathroom) ? ucwords(str_replace('-', ' ', $bathroom)) : NULL,
            !empty($furnishing) ? ucwords(str_replace('-', ' ', $furnishing)) : NULL,
            !empty($listedBy) ? (str_replace('-', ' ', $listedBy)) : NULL,
            !empty($constructionStatus) ? ucwords(str_replace('-', ' ', $constructionStatus)) : NULL,
            !empty($superBuiltupArea) ? ucwords(str_replace('-', ' ', $superBuiltupArea)) : NULL,
            !empty($plotArea) ? ucwords(str_replace('-', ' ', $plotArea)) : NULL,
            !empty($bachelorsAllowed) ? ucwords(str_replace('-', ' ', $bachelorsAllowed)) : NULL,
        ];
        /*
        $search
        @location
        $minPrice 
        $maxPrice 
        $minSalary 
        $maxSalary 
        $condition 
        $sPeriod
        $sPosition 
        $petAge
        $pGender 
        $minKm
        $maxKm, 
        $minYear
        $maxYear
        $fType
        $transmission
        $owner
        $hp
        $bType
        $bedroom
        $bathroom
        $furnishing
        $listedBy
        $constructionStatus
        $superBuiltupArea
        $plotArea
        $bachelorsAllowed

        */
        $title = str_replace($keysArr, $valuesArr, $title);
        return $title;
    }
}


if (!function_exists('sendMobileOTP')) {
    function sendMobileOTP($mobile)
    {
        $status = false;
        try {
            $client = new \GuzzleHttp\Client();
            $mobile = "91" . $mobile;
            $templateId = '6427d683d6fc057a7604b8b2';
            $response = $client->request('POST', "https://control.msg91.com/api/v5/otp?mobile=$mobile&template_id=$templateId", [
                // 'body' => '{"otp_length":6,"otp_expiry":5}',
                'headers' => [
                    'accept' => 'application/json',
                    'authkey' => config('global_variables.sms_smg91_api_key'),
                    'content-type' => 'application/json',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $responseBody = json_decode($response->getBody()->getContents(), true);
                if (isset($responseBody) && !empty($responseBody) && count($responseBody) > 0) {
                    if (
                        isset($responseBody['request_id']) && !empty($responseBody['request_id'])  &&
                        isset($responseBody['type']) && !empty($responseBody['type']) && $responseBody['type'] == 'success'

                    ) {
                        $status = true;
                    }
                }
            }
            return $status;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return $status;
        }
    }
}


if (!function_exists('verifyMobileOTP')) {
    function verifyMobileOTP($mobile, $otp)
    {
        $status = 0;
        try {
            $mobile = "91" . $mobile;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', "https://control.msg91.com/api/v5/otp/verify?otp=$otp&mobile=$mobile", [
                'headers' => [
                    'accept' => 'application/json',
                    'authkey' => config('global_variables.sms_smg91_api_key'),
                ],
            ]);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $responseBody = json_decode($response->getBody()->getContents(), true);
                if (isset($responseBody) && !empty($responseBody) && count($responseBody) > 0) {
                    if (
                        isset($responseBody['type']) && !empty($responseBody['type']) && $responseBody['type'] == 'success'

                    ) {
                        $status = 1;
                    } elseif (isset($responseBody['message']) && !empty($responseBody['message'])) {
                        $status = $responseBody['message'];
                    }
                }
            }
            return $status;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return $status;
        }
    }
} //end verifyMobileOTP


if (!function_exists('reSendMobileOTP')) {
    function reSendMobileOTP($mobile)
    {
        $status = false;
        try {
            $mobile = "91" . $mobile;
            $authkey = config('global_variables.sms_smg91_api_key');
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', "https://control.msg91.com/api/v5/otp/retry?authkey=$authkey&retrytype=text&mobile=$mobile", [
                'headers' => [
                    'accept' => 'application/json',
                    'authkey' => $authkey,
                ],
            ]);
            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $responseBody = json_decode($response->getBody()->getContents(), true);
                if (isset($responseBody) && !empty($responseBody) && count($responseBody) > 0) {
                    if (
                        isset($responseBody['type']) && !empty($responseBody['type']) && $responseBody['type'] == 'success'

                    ) {
                        $status = true;
                    }
                }
            }
            return $status;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return $status;
        }
    }
}


if (!function_exists('checkSexaulImage')) {
    function checkSexaulImage($argv)
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

            // Check if path to local image provided.
            // $data = ['url' => 'https://storage.googleapis.com/api4ai-static/samples/nsfw-1.jpg'];
            // if (array_key_exists(1, $argv)) {
            //     if (strpos($argv[1], '://')) {
            //         $data = ['url' => $argv[1]];
            //     } else {
            //         $filename = pathinfo($argv[1])['filename'];
            //         $data = ['image' => new CURLFile($argv[1], null, $filename)];
            //     }
            // }


            // $filename = $argv->getClientOriginalName();
            // $data = ['image' => new CURLFile($argv, null, $filename)];


            //   $file_server_path = realpath($argv);
            //  $data = ['image' => new \CURLFile($argv, 'text/plain', 'file')];
            $filename = $argv->getClientOriginalName();
            $filepath = storage_path( $argv->getPath());
            $data = ['image' =>  new CURLFile($filepath, null, $filename)];

            //   $cfile = ;

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
            $status = false;
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

                                        echo  "nsfw=" . $nsfw . "<br />";
                                        echo  "sfw=" . $sfw . "<br />";
                                        $status = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $status;







            // // echo "<pre>";
            // // print_r($raw_response);

            // // echo "<br/>------------------ <br />";

            // // // Print raw response.
            // // echo join(
            // //     '',
            // //     [
            // //         " Raw response:\n",
            // //         json_encode($raw_response),
            // //         "\n"
            // //     ]
            // // );

            // // // Parse response and probabilities.
            // $probs = $raw_response['results'][0]['entities'][0]['classes'];

            // // echo "<br/>------------------ <br />";
            // // echo "probs=" . $probs;

            // echo "<br/>";



            // // Close request session.
            // curl_close($request);

            // echo "<br/>------------------ <br />";

            // // Print probabilities.
            // echo join(
            //     '',
            //     [
            //         "\n Probabilities: \n",
            //         json_encode($probs, JSON_PRETTY_PRINT),
            //         "\n"
            //     ]
            // );
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}//end checkSexaulImage
