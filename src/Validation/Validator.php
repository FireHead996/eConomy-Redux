<?php

namespace App\Validation;

use Albert221\Validation\Validator as v;
use Albert221\Validation\Rule;

// Custom rules
use App\Validation\Rules\EmailAvailable as EmailAvailable;
use App\Validation\Rules\EmailOccupied as EmailOccupied;
use App\Validation\Rules\UsernameAvailable as UsernameAvailable;
use App\Validation\Rules\UsernameOccupied as UsernameOccupied;
use App\Validation\Rules\PasswordValid as PasswordValid;
use App\Validation\Rules\PasswordOld as PasswordOld;
use App\Validation\Rules\PasswordNotOld as PasswordNotOld;

class Validator extends v
{
    /**
     * Validate register form
     *
     * @param Request $request
     * @return Validator
     */
    public function validateRegisterForm($request)
    {
        $fields = [
            'email',
            'password',
            'name',
        ];

        foreach ($fields as $field) {
            $this->addField($field, $request->getParam($field));
            $this->addRule($field, new Rule\Required())
                ->setMessage('To pole nie może być puste');
            $this->addRule($field, new Rule\MinLength(3))
                ->setMessage('Wartość tego pola nie może być krótsza niż 3');
            $this->addRule($field, new Rule\MaxLength(25))
                ->setMessage('Wartość tego pola nie może być dłuższa niż 25');
        }

        $this->addRule('email', new Rule\Email())
            ->setMessage('Wprowadź poprawny adres email');
        $this->addRule('email', new EmailAvailable());
        $this->addRule('name', new UsernameAvailable());
        //$this->addRule('name', new Rule\Alphanumeric())
        //    ->setMessage('To pole przyjmuje tylko wartości alfanumeryczne');

        return $this->validate();
    }

    /**
     * Validate login form
     *
     * @param Request $request
     * @return Validator
     */
    public function validateLoginForm($request)
    {
        $fields = [
            'email',
            'password',
        ];

        foreach ($fields as $field) {
            $this->addField($field, $request->getParam($field));
            $this->addRule($field, new Rule\Required())
                ->setMessage('To pole nie może być puste');
        }

        $this->addRule('email', new EmailOccupied());
        $this->addRule('password', new PasswordValid($request->getParam('email')));

        return $this->validate();
    }

    /**
     * Validate password change form
     *
     * @param Request $request
     * @return Validator
     */
    public function validatePasswordChangeForm($request)
    {
        $fields = [
            'password_old',
            'password1',
            'password2',
        ];

        foreach ($fields as $field) {
            $this->addField($field, $request->getParam($field));
            $this->addRule($field, new Rule\Required())
                ->setMessage('To pole nie może być puste');
            $this->addRule($field, new Rule\MinLength(3))
                ->setMessage('Wartość tego pola nie może być krótsza niż 3');
            $this->addRule($field, new Rule\MaxLength(25))
                ->setMessage('Wartość tego pola nie może być dłuższa niż 25');
        }

        $this->addRule('password_old', new PasswordOld());
        $this->addRule('password1', new PasswordNotOld());
        $this->addRule('password2', new Rule\Equal($request->getParam('password1')))
            ->setMessage('Błędnie powtórzono hasło');

        return $this->validate();
    }
}
