<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerCompany extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'company_players';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'player_id',
        'name',
        'value',
        'workers',
        'production_time',
        'upgrade_time',
        'level',
        'open',
        'production',
        'last_fired_time',
    ];
}
