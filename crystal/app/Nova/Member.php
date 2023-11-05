<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\HasMany;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;

class Member extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Member::class;

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
        'id', 'name', 'email', 'phone'
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
        'id' => 'desc'
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
            Text::make('Username', 'name')
                ->sortable()
                ->rules('required', 'min:3', 'max:50'),
            Text::make('Phone Number (+91)', 'phone')
                ->sortable()
                ->rules('nullable',  'regex:/^[6-9]\d{9}$/'),
            Boolean::make('Is Whatsapp', 'isWhatsApp')
                ->sortable()
                ->hideFromIndex(),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:100')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults())
                ->hideFromIndex(),
            Number::make('Active Listing', 'listing')
                ->sortable()
                ->exceptOnForms()
                ->onlyOnIndex()
                ->hideOnExport(),


            Number::make('Total Listing', 'total_listing')
                ->onlyOnExport(),
            Number::make('Active Listing', 'listing')
                ->onlyOnExport(),
            Number::make('Inactive Listing', 'inactive_listing')
                ->onlyOnExport(),
            Number::make('Pending Listing', 'pending_listing')
                ->onlyOnExport(),
            Number::make('Expired Listing', 'expired_listing')
                ->onlyOnExport(),


            DateTime::make('Date of Creation', 'created_at')
                ->sortable()
                ->exceptOnForms()
                ->displayUsing(fn ($value) => $value ? $value->format('M d Y') : ''),

            Select::make('Status', 'status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),
            Number::make('Total Listing', 'total_listing')
                ->onlyOnDetail(),
            Number::make('Active Listing', 'listing')
                ->onlyOnDetail(),
            Number::make('Inactive Listing', 'inactive_listing')
                ->onlyOnDetail(),
            Number::make('Pending Listing', 'pending_listing')
                ->onlyOnDetail(),
            Number::make('Expired Listing', 'expired_listing')
                ->onlyOnDetail(),

            HasMany::make('ReportUser'),
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
            new Filters\UserStatus,
            new Filters\UserCreatedFrom,
            new Filters\UserCreatedTo,
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
            (new Actions\MemberStatusChange)
                ->confirmText('Are you sure you want to update the status of selected id(s)?')
                ->confirmButtonText('Yes')
                ->cancelButtonText("No"),
            (new DownloadExcel)->askForWriterType()->withHeadings()->withFilename('members-' . time()),
        ];
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->leftJoin(DB::raw("(SELECT user_id, COUNT(IF((status='active' && active_date >= CURDATE()), 1,0)) as listing, COUNT(id) as total_listing, COUNT(IF((status='inactive'), 1,0)) as inactive_listing, COUNT(IF((status='pending'), 1,0)) as pending_listing, COUNT(IF((active_date < CURDATE()), 1,0)) as  expired_listing FROM posts  GROUP BY user_id) as posts "), function ($join) {
            $join->on('users.id', '=', 'posts.user_id');
        })->where('users.user_type', 2);

        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
    }
}
