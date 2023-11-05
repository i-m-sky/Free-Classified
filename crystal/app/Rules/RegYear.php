<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class RegYear implements Rule
{
    private $curYear;
    private $erroMessage;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->curYear = Carbon::now()->format('Y');
        $this->erroMessage = '';
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
        if ($value <= 0) {
            $this->erroMessage = "Reg year should be greate than 0.";
            return false;
        } else if ($value > $this->curYear) {
            $this->erroMessage = "Reg year should be less than equalt to current year($this->curYear).";
            return false;
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
        return $this->erroMessage;
    }
}
