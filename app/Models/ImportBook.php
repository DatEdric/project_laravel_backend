<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportBook extends Model
{
    //
    protected $table = 'import_books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [''];

    public function book()
    {
        return $this->belongsTo(Book::class, 'ib_books_id', 'id');
    }
}
