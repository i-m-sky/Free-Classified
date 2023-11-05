<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Check5DigitFromAddName implements Rule
{
    public $field;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
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
        $string = $value;
        $isThereNumber = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            if (ctype_digit($string[$i])) {
                $isThereNumber++;
            }
        }
        if ($isThereNumber >= 5) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->field . ' cannot contain a phone number. Please modify it.';
    }
}
