<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'author',
        'genre',
        'publication_date',
        'count_words',
        'price'
    ];

    protected $casts = [
        'title' => 'string',
        'publisher' => 'string',
        'author' => 'string',
        'genre' => 'string',
        'publication_date' => 'string',
        'count_words' => 'integer',
        'price' => 'integer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
