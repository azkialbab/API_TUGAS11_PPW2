<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;

use App\Http\Resources\BookResource;

class BookApiController extends Controller
{
    public function index(){
        $books = Buku::latest()->paginate(5);

        return new BookResource(true, 'List Data Buku', $books);
    }
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|date',
            'genre' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        
        $book = Buku::create($validatedData);

        
        return new BookResource(true, 'Book Created Successfully', $book);
    }
}
