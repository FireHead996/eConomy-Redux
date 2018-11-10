<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;

class MoreOrEqualZero implements RuleInterface
{
    use RuleTrait;

    /**
     * Rule constructor
     */
    public function __construct()
    {
        $this->message = 'Ta liczba nie jest liczbą większą lub równą zero';
    }

    /**
     * Validation method
     *
     * @param integer $value
     * @return bool
     */
    public function test($value)
    {
        if ($value < 0) {
            return false;
        }

        return true;
    }
}
