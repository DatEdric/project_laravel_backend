<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classs extends Model
{
    //
    protected $table = 'class';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'c_name', 'created_at', 'updated_at'
    ];
}
