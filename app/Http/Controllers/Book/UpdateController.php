<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Book;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Book $book, UpdateRequest $request)
    {
        $book = $book->update($request->all());
        return $book;
    }
}
