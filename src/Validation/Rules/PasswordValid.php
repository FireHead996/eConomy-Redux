<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class PasswordValid implements RuleInterface
{
    use RuleTrait;

    /**
     * Email address
     *
     * @var string
     */
    protected $email;

    /**
     * Rule constructor
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->message = 'Podane hasło jest nieprawidłowe';
        $this->email = $email;
    }

    /**
     * Validation method
     *
     * @param string $value
     * @return bool
     */
    public function test($value)
    {
        $user = User::where('email', $this->email)->first();
        
        if (!$user) {
            $this->message = 'Wypełnij poprawnie adres email';
            return false;
        }
        
        if (password_verify($value, $user->password)) {
            return true;
        }

        return false;
    }
}
