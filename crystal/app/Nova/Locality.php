<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Alexwenzel\AjaxSelect\AjaxSelect;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;

class Locality extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Locality::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'slug'
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
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'max:100'),
            Slug::make('Slug')->from('name')->separator('-')
                ->sortable()
                ->rules('required', 'max:125')
                ->creationRules('unique:cities,slug')
                ->updateRules('unique:cities,slug,{{resourceId}},id')
                ->hideFromIndex(),
            Number::make('Active Listing', 'listing')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('State', 'state', 'App\Nova\State')
                ->sortable()
                ->searchable()
                ->rules('required'),
            BelongsTo::make('City', 'city', 'App\Nova\\City')
                ->sortable()
                ->rules('required')
                ->searchable()
                ->exceptOnForms(),
            AjaxSelect::make('City', 'city_id')
                ->get('/api/cities/{state}')
                ->parent('state')
                ->sortable()
                ->rules('required')
                ->onlyOnForms(),
            Select::make('Status', 'status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
        ];
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
            new Filters\LocalityStatus,
            new Filters\LocalityState,
            new Filters\LocalityCity
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
            (new Actions\LocalityStatusChange)
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
        $query->leftJoin(DB::raw("(SELECT locality_id, COUNT(IF(status='active', 1,0)) as listing FROM posts WHERE active_date >= CURDATE()  GROUP BY locality_id) as posts "), function ($join) {
            $join->on('localities.id', '=', 'posts.locality_id');
        });
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }
}
