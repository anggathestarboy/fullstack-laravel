<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
   use HasFactory;
   protected $fillable = [
    'book_id',
    'book_category_id',
    'book_publisher_id',
    'book_shelf_id',
    'book_author_id',
    'book_name',
    'book_isbn',
    'book_stock',
    'book_description',
    'book_img',
];

public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'book_author_id', 'author_id');
    }

}
