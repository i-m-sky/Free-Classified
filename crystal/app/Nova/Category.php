<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Alexwenzel\DependencyContainer\HasDependencies;
use Alexwenzel\DependencyContainer\DependencyContainer;
use Alexwenzel\DependencyContainer\ActionHasDependencies;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use \App\Models\Category as CategoryModel;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'h1_title', 'slug'
    ];

    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static $perPageOptions = [25, 50, 100, 150, 200, 500, 1000];

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'name' => 'asc'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Select::make('Parent Category', 'parent_id')->options(function () {
                $cat = [];
                $categories =  DB::table('categories')->select('id', 'name', 'parent_id')->get();
                $parentCat =  collect($categories)->where('parent_id', 0)->sortBy('name');
                $id = 0;
                $name = '-';
                $cat[$id] = $name;
                if (count($parentCat)) {
                    foreach ($parentCat as $key => $c) {
                        $id = $c->id;
                        $name = $c->name;
                        $cat[$id] = $name; // . '(' . $id . ')';
                        $level = 0;
                        $cat = $this->getChild($categories, $id, $cat, $name, $level);
                    }
                }
                return $cat;
            })->displayUsingLabels()
                ->searchable()
                ->sortable()
                ->rules('required'),

            Text::make('Category Name', 'name')
                ->sortable()
                ->rules('required', 'max:100'),
            Text::make('Heading (H1)', 'h1_title')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),


            Slug::make('Slug')->from('name')->separator('-')
                ->sortable()
                ->rules('required', 'max:125')
                ->creationRules('unique:categories,slug')
                ->updateRules('unique:categories,slug,{{resourceId}},id')
                ->hideFromIndex()
                ->hideFromIndex(),
            Text::make('Title', 'meta_title')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            DependencyContainer::make([
                Textarea::make('Title Note', function () {
                    return '@search => Search Text, @location => Location, @minprice => Minimum Price, @maxPrice => Maximum Price, @minsalary => Minimum Salary, @maxSalary => Maximum Salary, @condition => Condition, @sPeriod => Salary Period, @sPosition => Salary Position , @petAge => Pet Age, @pGender => Pet Gender, @minKm => Minimum Kilometer, @maxKm => Maximum Kilometer, @minYear => Minimum Year, @maxYear => Maximum Year, @fType => Fuel Type, @transmission => Transmission,  @owner => Owner, @hp => HP Power, @bType => Body Type, @bedroom => Bedroom, @bathroom => Bathroom, @furnishing => Furnishing, @listedBy => Listed By, @constructionStatus => Construction Status, @superBuiltupArea => Super Builtup Area, @plotArea => Plot Area,  @bachelorsAllowed => Bachelors Allowed';
                })->rows(15)->hideFromIndex()->readonly(),

            ])->dependsOnNotEmpty('parent_id'),

            DependencyContainer::make([
                Textarea::make('Title Note', function () {
                    return '@search => Search Text, @location => Location, @minprice => Minimum Price, @maxPrice => Maximum Price, @minsalary => Minimum Salary, @maxSalary => Maximum Salary, @condition => Condition, @sPeriod => Salary Period, @sPosition => Salary Position , @petAge => Pet Age, @pGender => Pet Gender, @minKm => Minimum Kilometer, @maxKm => Maximum Kilometer, @minYear => Minimum Year, @maxYear => Maximum Year, @fType => Fuel Type, @transmission => Transmission,  @owner => Owner, @hp => HP Power, @bType => Body Type, @bedroom => Bedroom, @bathroom => Bathroom, @furnishing => Furnishing, @listedBy => Listed By, @constructionStatus => Construction Status, @superBuiltupArea => Super Builtup Area, @plotArea => Plot Area,  @bachelorsAllowed => Bachelors Allowed';
                })->rows(15)->hideFromIndex()->readonly(),

            ])->dependsOnNullOrZero('parent_id'),


            NovaTinyMCE::make('Description', 'description')
                ->hideFromIndex()
                ->options([
                    //'use_lfm' => true
                ]),
            Textarea::make('Meta Description', 'meta_description')
                ->rows(3)
                ->hideFromIndex(),
            Textarea::make('Meta Keywords', 'meta_keyword')
                ->rows(3)
                ->hideFromIndex(),
            Number::make('Active Listing', 'listing')
                ->sortable()
                ->exceptOnForms(),
            Select::make('Status', 'status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

        ];
    }


    public function getChild($categories, $parentId, $cat, $parentName, $level)
    {
        $parentCat =  collect($categories)->where('parent_id', $parentId)->sortBy('name');
        if (count($parentCat)) {
            foreach ($parentCat as $key => $c) {
                $id = $c->id;
                // $name = (!empty($parentName) ? $parentName . ' > ' : '') . $c->name; //. '(' . $id . ')';

                $prefix = '';
                // for ($i = 0; $i <= $level; $i++) {
                //     $prefix .= '>';
                // }
                $name =  $prefix . $c->name;
                $cat[$id] = $name;
                $cat = $this->getChild($categories, $id, $cat, $name, $level);
            }
        }
        return $cat;
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new Filters\CategoryCategory,
            new Filters\CategoryStatus,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new Actions\CategoryStatusChange)
                ->confirmText('Are you sure you want to update the status of selected id(s)?')
                ->confirmButtonText('Yes')
                ->cancelButtonText("No"),
        ];
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->leftJoin(DB::raw("(SELECT category_id, COUNT(IF(status='active', 1,0)) as listing FROM posts WHERE active_date >= CURDATE()  GROUP BY category_id) as posts "), function ($join) {
            $join->on('categories.id', '=', 'posts.category_id');
        });
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }
}
