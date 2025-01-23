<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Myitem extends Model
{
    protected $fillable = [
        'name',
        'item_url',
        'list_id'
    ];
}
