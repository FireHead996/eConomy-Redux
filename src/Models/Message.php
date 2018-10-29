<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'id',
        'from',
        'to',
        'subject',
        'content',
        'status',
        'type',
    ];
    
    public function convertIDsToNicks()
    {
        $this->from = User::find($this->from)->nickname;
        $this->to = User::find($this->to)->nickname;
    }
}
