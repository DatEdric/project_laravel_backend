<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $table = 'books';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'b_categories_id ',
        'b_publishing_company_id ',
        'b_name',
        'b_image',
        'b_description',
        'b_code_book',
        'b_amount_liquidated',
        'b_price',
        'b_status',
        'ib_issue_number',
        'b_publishing_year',
        'ib_amount',
        'created_at',
        'updated_at',
    ];
    protected $guarded = [''];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'b_categories_id', 'id');
    }

    public function publishingCompany()
    {
        return $this->belongsTo(PublishingCompany::class, 'b_publishing_company_id', 'id');
    }

    public function amount()
    {
        return $this->hasMany(ImportBook::class, 'ib_books_id', 'id');
    }

    public function authorBook()
    {
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'd_book_id', 'id');
    }
}
