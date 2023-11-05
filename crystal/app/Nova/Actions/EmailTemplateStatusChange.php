<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Select;

class EmailTemplateStatusChange extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * The displayable name of the action.
     *
     * @var string
     */

    public $name = 'Change Status';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $status = $fields->status;
        $requestIds = [];
        foreach ($models as $model) {
            array_push($requestIds, $model->id);
        }
        if (count($requestIds) > 0) {
            DB::table('email_templates')->whereIn('id', $requestIds)->update([
                'status' => $status,
                'updated_by' => Auth::id()
            ]);
            return Action::message("Selected id(s)'s status has been changed successfully as '" . ucfirst($status) . "'.");
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Status', 'status')->options(['inactive' => 'Inactive', 'active' => 'Active'])->displayUsingLabels()->rules('required'),
        ];
    }
}
