<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeEvent extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'exchange_events';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'content',
    ];
}
