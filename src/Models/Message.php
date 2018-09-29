<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'subject',
        'content',
        'status',
        'type',
    ];
}
