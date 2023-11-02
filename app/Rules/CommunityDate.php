<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class CommunityDate implements Rule
{
    private $type;
    private $toDate;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type, $toDate = null)
    {
        $this->type = $type;
        $this->toDate = $toDate;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $currentDate = Carbon::now();
        $val = Carbon::createFromFormat('m/d/Y', $value);
        if ($this->type == 1) {
            if ($val < $currentDate) {
                return false;
            }
        } else   if ($this->type == 2) {
            if (empty($this->toDate)) {
                return false;
            } else {
                $tpDate = Carbon::createFromFormat('m/d/Y', $this->toDate);
                if ($val < $tpDate) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->type == 1) {
            return 'Date should be greater or equal to today.';
        } else   if ($this->type == 2) {
            if (empty($this->toDate)) {
                return 'To date is required';
            } else {
                return 'To date should be greater or equal to from date. ';
            }
        }
    }
}
