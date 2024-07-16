<?php

namespace App\Repository;

use App\Models\Book;

class BookRepository
{


    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function get()
    {
        return $this->book
            ->query()
            ->get();
    }

    public function store($data)
    {
        $this->book
            ->query()
            ->create($data);
    }

    public function update($book, $data)
    {
        $book->update($data);
    }

    public function delete($book)
    {
        $book->delete();
    }


}
