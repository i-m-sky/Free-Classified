<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FullTextMatched implements Rule
{
    public $field;
    public $ads;
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
        $this->ads = DB::table('posts')->select('name', 'description')
            ->where(function ($query) {
                $query
                    ->orWhere('plan_end_date', '<', '' . date('Y-m-d') . '')
                    ->orWhereNUll('plan_end_date');
            })->where('user_id', Auth::id())->get();
        if (count($this->ads) > 0) {
            if ($this->field == 'ad_title') {
                return $this->getTextMatched('name', $value);
            } else if ($this->field == 'description') {
                return $this->getTextMatched('description', $value);
            }
        }
        return true;
    }

    private function getTextMatched($type, $value)
    {
        $lengthArr = [];
        $l = 0;
        foreach ($this->ads as $key => $ad) {
            if ($ad->$type == $value) {
                $l++;
                $lengthArr[$key] = $l;
            }
        }
        if (count($lengthArr) > 0) {
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
        return 'Duplicate Content, Please Write a Unique Content';
    }
}
