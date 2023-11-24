<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueProfileSlug implements ValidationRule
{
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (\App\Models\MentorProfile::where('display_name', $value)->where('user_id', '!=', $this->user_id)->count() !== 0) {
            $fail('profile name should be unique');
        }
    }
}



