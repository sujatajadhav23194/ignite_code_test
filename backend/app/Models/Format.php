<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = 'books_format';
    protected $fillable = ['book_id', 'mime_type', 'url'];
}
