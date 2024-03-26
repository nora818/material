<?php

namespace App\Http\Controllers;

use App\Models\Book;

class IndexController extends Controller
{
    public function index()
    {
        // $books = Book::query()->paginate(9);
        $books = [];
        return view("index",  ['books' => $books]);
    }
}
