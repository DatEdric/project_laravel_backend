<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    //
    protected $table = 'borrow';
    protected $guarded = [''];

    public function reader()
    {
        return $this->hasOne(Reader::class, 'id', 'b_reader_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'd_borrow_id', 'id');
    }
}
