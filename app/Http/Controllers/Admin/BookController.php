<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Shelf;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category', 'publisher', 'shelf'])->paginate(5);
         $authors = Author::all();
         $categories = Category::all();
         $publishers = Publisher::all();
         $shelves = Shelf::all();
        return view('pages.admin.book', compact('books', 'authors', 'categories', 'publishers', 'shelves'));
    }

    public function create()
    {
        return view('pages.admin.book.create', [
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'shelves' => Shelf::all(),
        ]);
    }

    public function store(BookRequest $request)
    {
        Book::create($request->validated());
        return redirect('/book')->with('success', 'Book created successfully.');
    }

    // public function edit(Book $book)
    // {
    //     return view('pages.admin.book.edit', [
    //         'book' => $book,
    //         'authors' => Author::all(),
    //         'categories' => Category::all(),
    //         'publishers' => Publisher::all(),
    //         'shelves' => Shelf::all(),
    //     ]);
    // }

    // public function update(BookRequest $request, Book $book)
    // {
    //     $book->update($request->validated());
    //     return redirect()->route('pages.admin.book')->with('success', 'Book updated successfully.');
    // }

    // public function destroy(Book $book)
    // {
    //     $book->delete();
    //     return redirect()->route('pages.admin.book')->with('success', 'Book deleted successfully.');
    // }

    
}
