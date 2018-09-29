<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class PasswordNotOld implements RuleInterface
{
    use RuleTrait;

    /**
     * Rule constructor
     */
    public function __construct()
    {
        $this->message = 'Podane hasło jest nieprawidłowe';
    }

    /**
     * Validation method
     *
     * @param string $value
     * @return bool
     */
    public function test($value)
    {
        $user = User::find($_SESSION['user']);
        
        if (!$user) {
            return false;
        }
        
        if (!password_verify($value, $user->password)) {
            return true;
        }

        return false;
    }
}
