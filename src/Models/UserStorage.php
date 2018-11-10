<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStorage extends Model
{
    /**
     * Model table
     *
     * @var string
     */
    protected $table = 'user_storage';

    /**
     * Array of fillable fields of table
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'raw_materials',
        'fabrics',
        'equipments',
        'food',
    ];
    
    /**
     * Update user storage
     * 
     * @param type $type
     * @param type $val
     */
    public function setStorage($type, $val)
    {
        $this->update([
            $type => $val,
        ]);
    }
}