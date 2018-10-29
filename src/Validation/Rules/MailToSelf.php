<?php

namespace App\Validation\Rules;

use Albert221\Validation\Rule\RuleInterface;
use Albert221\Validation\Rule\RuleTrait as RuleTrait;
use App\Models\User;

class MailToSelf implements RuleInterface
{
    use RuleTrait;

    /**
     * User ID
     *
     * @var string
     */
    protected $id;

    /**
     * Rule constructor
     *
     * @param string $email
     */
    public function __construct($id)
    {
        $this->message = 'Nie możesz napisać do siebie';
        $this->id = $id;
    }

    /**
     * Validation method
     *
     * @param string $value
     * @return bool
     */
    public function test($value)
    {
        $user = User::find($this->id);
        
        if ($user->nickname == $value) {
            return false;
        }

        return true;
    }
}
