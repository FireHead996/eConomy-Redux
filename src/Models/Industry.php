<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'industry_types';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'product_id',
    ];
}
