<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordRestrict implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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

        if (getWordRestriction($value) == false) {
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
        $words = getSettingValue('negative_keyword');

        return "We do not allow content promoting the sexual, violent, or other exploitation of minors. Please edit the field.";
    }
}
