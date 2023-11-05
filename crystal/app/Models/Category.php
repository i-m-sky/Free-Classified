<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',
        'h1_title',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_by',
        'updated_by',
        'home_description',
        'hierarchical_ids'
    ];


    public static function boot()
    {
        parent::boot();

        static::saving(function ($row) {
            unset($row->ComputedField);
            $row->created_by = Auth::id();
        });

        static::saved(function ($row) {
            $hierarchical_ids = [$row->id];
            //getParentId($row->parent_id, $hierarchical_ids);
        });

        static::updating(function ($row) {
            unset($row->ComputedField);
            $row->updated_by = Auth::id();
        });

        // function getParentId($parentId, $hierarchical_ids)
        // {
        //     $parentCat =  DB::table('categories')->where('id', $parentId)->select('id', 'parent_id')->first();
        //     if (!empty($parentCat)) {
        //         getChild($parentCat->id);
        //     }
        // }

        // function getChild($parentId)
        // {
        //     $parentCat =  DB::table('categories')->where('parent_id', $parentId)->select('id', 'parent_id')->get();
        //     if (count($parentCat)) {
        //         foreach ($parentCat as $key => $c) {
        //             $id = $c->id;
        //             DB::table('categories')->where('id', $id)->update(['hierarchical_ids' => $id]);
        //             getChild($id);
        //         }
        //     }
        // }
        // DB::table('categories')->where('id', $this->id)->delete();
    }
}
