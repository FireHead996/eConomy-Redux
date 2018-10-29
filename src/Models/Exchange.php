<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'exchange';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'last_change',
        'raw_materials',
        'raw_materials_hossa',
        'fabrics',
        'fabrics_hossa',
        'equipment',
        'equipment_hossa',
        'food',
        'food_hossa'
    ];
}
