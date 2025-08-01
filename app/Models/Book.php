<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
   use HasFactory;
   public $incrementing = false; // Jika kamu pakai UUID

    protected $fillable = [
    'book_id', // tambahkan ini
    'book_name',
    'book_isbn',
    'book_img',
    'book_description',
    'book_stock',
    'book_author_id',
    'book_category_id',
    'book_publisher_id',
    'book_shelf_id',
];

public function author() {
    return $this->belongsTo(Author::class, 'book_author_id', 'author_id');
}

public function category() {
    return $this->belongsTo(Category::class, 'book_category_id', 'category_id');
}

public function publisher() {
    return $this->belongsTo(Publisher::class, 'book_publisher_id', 'publisher_id');
}

public function shelf() {
    return $this->belongsTo(Shelf::class, 'book_shelf_id', 'shelf_id');
}

protected static function boot()
{
    parent::boot();

    static::creating(function ($book) {
        $book->book_id = Str::uuid();
    });
}

}
