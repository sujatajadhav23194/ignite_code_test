<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{

    protected $table = 'books_book';

    protected $fillable = ['id', 'download_count','gutenberg_id','media_type','title'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'books_book_authors', 'book_id', 'author_id');
    }

    public function bookshelves()
    {
        return $this->belongsToMany(Bookshelf::class, 'books_book_bookshelves', 'book_id', 'bookshelf_id');
    }

    public function formats()
    {
        return $this->hasMany(Format::class, 'book_id');
    }

   
}
