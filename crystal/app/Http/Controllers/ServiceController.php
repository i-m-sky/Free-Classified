<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function checkSexaulImageforPendingPost()
    {
        try {
            DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => 'Job-called ' . date('Y-m-d H:i:s')]);


            $posts = DB::table('posts')->where('status', 'pending')->select(['image_path_1', 'image_path_2', 'image_path_3', 'image_path_4', 'image_path_5', 'id'])->get();
            if (count($posts) > 0) {
                DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => 'Job-called ' . date('Y-m-d H:i:s'). 'Step-1']);

                foreach ($posts as $p) {
                    $postStatus = 0;
                    $nsfService = 0;
                    for ($i = 1; $i <= 5; $i++) {
                        $fieldName = 'image_path_' . $i;
                        $imageName = $p->$fieldName;
                        if (!empty($imageName)) {
                            $imgStatus =  checkSexaulImage($imageName);
                            DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => 'Job-called ' . date('Y-m-d H:i:s'). 'Step-2='.$imgStatus]);
                            if ($imgStatus == 1) {
                                $postStatus++;
                            } else  if ($imgStatus == 1) {
                                $nsfService++;
                            }
                        }
                    }
                    if ($postStatus == 0 && $nsfService == 0) {
                        DB::table('posts')->where('id', $p->id)->update(['status' => 'active']);
                        DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => 'Job-called ' . date('Y-m-d H:i:s'). 'Step-3']);
                    } else {
                        if ($postStatus > 0) {
                            DB::table('posts')->where('id', $p->id)->update(['status' => 'nsfw']);
                            DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => 'Job-called ' . date('Y-m-d H:i:s'). 'Step-4']);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::table('service_log')->insert(['title' => 'ServiceController:checkSexaulImageforPendingPost', 'description' => $th->getMessage()]);
        }
    }

    public function deletePost()
    {
        $date90 = Carbon::now()->subDays(90)->format('Y-m-d');
        $date30 = Carbon::now()->subDays(30)->format('Y-m-d');
        $imgPath = config('global_variables.image_upload_path');
        try {
            DB::table('service_log')->insert([
                'title' => 'delete-post',
                'description' => $date90 . '@' . $date30
            ]);
            $posts = DB::table('posts')->select('id', 'image_path_1', 'image_path_2',  'image_path_3', 'image_path_4',  'image_path_5', 'active_date')->where('active_date', '<=', $date90)->get();
            if (count($posts) > 0) {
                DB::table('service_log')->insert([
                    'title' => 'step-1',
                    'description' => 'Total=' . count($posts)
                ]);
                foreach ($posts as $p) {
                    if (!empty($p->image_path_1)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_1);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_1);
                    }
                    if (!empty($p->image_path_2)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_2);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_2);
                    }
                    if (!empty($p->image_path_3)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_3);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_3);
                    }
                    if (!empty($p->image_path_4)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_4);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_4);
                    }
                    if (!empty($p->image_path_5)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_5);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_5);
                    }
                    DB::table('posts')->where('id', $p->id)->delete();
                }
                DB::table('service_log')->insert([
                    'title' => 'step-1',
                    'description' => 'Completed'
                ]);
            }


            // $postDeleted = DB::table('posts')->select('id', 'image_path_1', 'image_path_2',  'image_path_3', 'image_path_4',  'image_path_5', 'active_date')->whereNotNull('deleted_at')->get();
            // if (count($postDeleted) > 0) {
            //     DB::table('service_log')->insert([
            //         'title' => 'step-2',
            //         'description' => 'Total=' . count($postDeleted)
            //     ]);
            //     foreach ($postDeleted as $p) {
            //         if (!empty($p->image_path_1)) {
            //             @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_1);
            //             @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_1);
            //         }
            //         if (!empty($p->image_path_2)) {
            //             @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_2);
            //             @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_2);
            //         }
            //         if (!empty($p->image_path_3)) {
            //             @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_3);
            //             @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_3);
            //         }
            //         if (!empty($p->image_path_4)) {
            //             @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_4);
            //             @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_4);
            //         }
            //         if (!empty($p->image_path_5)) {
            //             @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_5);
            //             @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_5);
            //         }
            //         DB::table('posts')->where('id', $p->id)->delete();
            //     }
            //     DB::table('service_log')->insert([
            //         'title' => 'step-2',
            //         'description' => 'Completed'
            //     ]);
            // }

            $postPending = DB::table('posts')->select('id', 'image_path_1', 'image_path_2',  'image_path_3', 'image_path_4',  'image_path_5', 'active_date')->where('status', 'pending')->where('active_date', '<=', $date30)->get();
            if (count($postPending) > 0) {
                DB::table('service_log')->insert([
                    'title' => 'step-3',
                    'description' => 'Total=' . count($postPending)
                ]);
                foreach ($postPending as $ad) {
                    if (!empty($p->image_path_1)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_1);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_1);
                    }
                    if (!empty($p->image_path_2)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_2);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_2);
                    }
                    if (!empty($p->image_path_3)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_3);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_3);
                    }
                    if (!empty($p->image_path_4)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_4);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_4);
                    }
                    if (!empty($p->image_path_5)) {
                        @Storage::delete($imgPath . '/public/cms/post/list/' . $p->image_path_5);
                        @Storage::delete($imgPath . '/public/cms/post/detail/' . $p->image_path_5);
                    }
                    DB::table('posts')->where('id', $p->id)->delete();
                }
                DB::table('service_log')->insert([
                    'title' => 'step-3',
                    'description' =>  'Completed'
                ]);
            }
        } catch (\Throwable $th) {
            DB::table('service_log')->insert([
                'title' => 'ServiceController:deletePost',
                'description' => $th->getMessage()
            ]);
        }
    } //end deletePost
}
