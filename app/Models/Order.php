<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $guarded = [''];
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'd_book_id');
    }

    public function reader()
    {
        return $this->hasOne(Reader::class, 'id', 'd_reader_id');
    }
}
