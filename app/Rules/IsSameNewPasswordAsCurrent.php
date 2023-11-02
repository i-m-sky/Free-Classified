<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsSameNewPasswordAsCurrent implements Rule
{
    public $currentPassord;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($currentPassord)
    {
        $this->currentPassord = $currentPassord;
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
        if(strcmp(trim($value), trim($this->currentPassord)) !== 0 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Current password and password shouldn't be same.";
    }
}
