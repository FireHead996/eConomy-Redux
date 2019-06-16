<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'company_types';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'industry_type',
        'cost',
        'points',
        'max_workers',
        'cost',
        'points',
        'max_workers',
        'production_per_worker',
        'upgrade_cost',
        'production_growth',
        'upgrade_points',
        'upgrade_max_workers',
        'hire_cost',
        'fire_cost',
        'max_level',
    ];
}
