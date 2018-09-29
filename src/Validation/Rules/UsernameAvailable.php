<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class UsernameAvailable implements RuleInterface
{
    use RuleTrait;

    /**
     * Rule constructor
     */
    public function __construct()
    {
        $this->message = 'Ta nazwa jest już zajęta';
    }

    /**
     * Validation method
     *
     * @param string $value
     * @return bool
     */
    public function test($value)
    {
        return User::where('nickname', $value)->count() === 0;
    }
}
