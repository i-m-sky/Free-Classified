<?php

namespace App\Nova\Filters;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class PostCategory extends Filter
{
    /**
     * The displayable name of the action.
     *
     * @var string
     */

    public $name = 'Categories';

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        $catIds = [$value];
        $cat = getCategoryChildHierarchical($value);
        if (!empty($cat) && count($cat) > 0) {
            foreach ($cat as $c) {
                array_push($catIds, $c['id']);
            }
        }
        return $query->whereIn('category_id', $catIds);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        $cat = [];
        $categories =  DB::table('categories')->select('id', 'name', 'parent_id')->get();
        $parentCat =  collect($categories)->where('parent_id', 0)->sortBy('name');
        if (count($parentCat)) {
            foreach ($parentCat as $c) {
                $id = $c->id;
                $name = $c->name;
                $cat[$id] = $name;
                $cat = $this->getChild($categories, $id, $cat, $name);
            }
        }
        $cats = [];
        if (count($cat) > 0) {
            foreach ($cat as $key => $val) {
                $cats[$val] = $key;
            }
        }
        return $cats;
    }

    public function getChild($categories, $parentId, $cat, $parentName, $level = 0)
    {
        $parentCat =  collect($categories)->where('parent_id', $parentId)->sortBy('name');
        if (count($parentCat)) {
            $level = $level + 1;
            foreach ($parentCat as  $c) {
                $id = $c->id;
                $prefix = '';
                for ($j = 0; $j < $level; $j++) {
                    $prefix .= ''; //>;
                }
                $name =  $prefix . $c->name;
                $cat[$id] = $name;
                $cat = $this->getChild($categories, $id, $cat, $name, $level);
            }
        }
        return $cat;
    }
}
