<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreRequest $request)
    {
        $request->validated();
        $book = Book::create($request->all());
        return new JsonResource($book);
    }
}
