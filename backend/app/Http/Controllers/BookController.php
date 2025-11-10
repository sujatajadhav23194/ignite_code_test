<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['authors', 'bookshelves', 'formats']);

        // Filter by category (topic)
        if ($request->has('topic')) {
            $topic = $request->topic;
            $query->whereHas('bookshelves', function($q) use ($topic) {
                $q->where('name', 'ilike', $topic);
            });
        }

        // Search by title or author
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'ilike', "%$search%")
                    ->orWhereHas('authors', function($a) use ($search) {
                        $a->where('name', 'ilike', "%$search%");
                    });
            });
        }

        // Only books with cover
        // $query->whereNotNull('cover_url');

        // Paginate
        $books = $query->paginate(20);

        // Transform for frontend
        $books->getCollection()->transform(function ($book) {
            // Get preferred format
            $formatLink = $book->formats
                ->where('mime_type', 'like', '%text/html%')->pluck('url')->first()
                ?? $book->formats->where('mime_type', 'like', '%pdf%')->pluck('url')->first()
                ?? $book->formats->where('mime_type', 'like', '%plain%')->pluck('url')->first();

            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->authors->pluck('name')->join(', '), // single string for frontend
                'category' => $book->bookshelves->pluck('name')->join(', '),
                'cover_image' => $book->cover_url, // add cover for frontend
                'book_url' => $formatLink
            ];
        });

        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::where('gutenberg_id', $id)->firstOrFail();
        return response()->json($book);
    }
}
