<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;

class CategoryCategory extends Filter
{
    /**
     * The displayable name of the action.
     *
     * @var string
     */

    public $name = 'Catagory';
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
        return $query->where('categories.parent_id', $value);
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
        $id = 0;
        $name = 'None';
        $cat[$name] = $id;
        if (count($parentCat)) {
            foreach ($parentCat as $key => $c) {
                $id = $c->id;
                $name = $c->name;
                $cat[$name] = $id;
                $level = 0;
                $cat = $this->getChild($categories, $id, $cat, $name, $level);
            }
        }
        return $cat;
    }

    public function getChild($categories, $parentId, $cat, $parentName, $level)
    {
        $parentCat =  collect($categories)->where('parent_id', $parentId)->sortBy('name');
        $level++;
        if (count($parentCat)) {
            foreach ($parentCat as $key => $c) {
                $id = $c->id;
                $prefix = '';
                for ($i = 0; $i < $level; $i++) {
                    $prefix .= '>';
                }
               
                // $name = (!empty($parentName) ? $parentName . ' > ' : '') . $c->name;
                $name = $prefix . $c->name;
                $cat[$name] = $id;
                $cat = $this->getChild($categories, $id, $cat, $name, $level);
            }
            
        }
        return $cat;
    }
}
