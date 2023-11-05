<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Emilianotisato\NovaTinyMCE\NovaTinyMCE;
use Laravel\Nova\Http\Requests\NovaRequest;

class Content extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Content::class;

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

            ID::make()->sortable()->hideFromIndex(),
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'max:100'),
            Text::make('Heading (H1)', 'h1_title')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),
            Slug::make('Slug')->from('name')->separator('-')
                ->sortable()
                ->rules('required', 'max:125')
                ->creationRules('unique:contents,slug')
                ->updateRules('unique:contents,slug,{{resourceId}},id')
                ->hideFromIndex()
                ->hideFromIndex(),
            Text::make('Title', 'meta_title')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),
            NovaTinyMCE::make('Description', 'description')
                ->hideFromIndex()
                ->options([
                   // 'use_lfm' => true
                ]),
            Textarea::make('Meta Description', 'meta_description')
                ->rows(3)
                ->hideFromIndex(),
            Textarea::make('Meta Keywords', 'meta_keyword')
                ->rows(3)
                ->hideFromIndex(),
            Select::make('No Follow', 'no_follow')->options([
                'yes' => 'Yes',
                'no' => 'No',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            Select::make('Add to sitemap.xml', 'sitemap')->options([
                'yes' => 'Yes',
                'no' => 'No',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Select::make('Status', 'status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            Textarea::make('Cards', 'meta_card')
                ->rows(3),
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
            new Filters\ContentStatus,
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
            (new Actions\ContentStatusChange)
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
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }
}
