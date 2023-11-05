<?php

namespace App\Nova\Filters;

use App\Models\Member;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class ReportUserBy extends Filter
{
    /**
     * The displayable name of the action.
     *
     * @var string
     */

    public $name = 'Report BY';

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
        return $query->where('user_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return  Member::where('user_type', 2)->whereRaw("id IN (SELECT user_id FROM user_reports GROUP BY user_id)")->pluck('id', 'name');
    }
}
