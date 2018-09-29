<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'nickname',
        'cash',
        'bank_acc',
        'avatar',
        'banned',
        'last_action',
    ];

    /**
     * Update password
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}
