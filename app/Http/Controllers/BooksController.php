<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store() {
        Book::create($this->validateBookRequest());
    }

    public function update(Book $book) {
        $book->update($this->validateBookRequest());
    }

    public function validateBookRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
