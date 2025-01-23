<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mylist extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function items() {
        return $this->hasMany(Myitem::class, 'list_id');
    }
}
