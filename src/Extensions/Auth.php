<?php

namespace App\Extensions;

use App\Models\User;
use App\Models\UserStorage;

class Auth
{
    use \App\Traits\Containerable;
    
    /**
     * Returns true if user is logged, false otherwise
     *
     * @return bool
     */
    public function check()
    {
        return $this->session->exists('user');
    }

    /**
     * Returns user model, false otherwise
     *
     * @return User / false
     */
    public function user()
    {
        return $this->check() ? User::find($this->session->get('user')) : false;
    }
    
    /**
     * Returns user storage model, false otherwise
     */
    public function userStorage()
    {
        return $this->check() ? UserStorage::where('uid', $this->session->get('user'))->first() : false;
    }

    /**
     * Attempt to log in user with given credentials
     *
     * @param string $email    User email
     * @param string $password User password
     * @return bool
     */
    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user)
        {
            return false;
        }

        if (password_verify($password, $user->password))
        {
            $this->session->set('user', $user->id);
            return true;
        }
        
        return false;
    }

    /**
     * Log out current user
     *
     * @return void
     */
    public function logout()
    {
        $this->session->delete('user');
    }
}
