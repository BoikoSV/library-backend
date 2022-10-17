<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        $book = $request->all();
        if ($request->hasFile('image')){
            $book['image'] = '';
            $image = $request->file('image')->store('images/books', 'public');
            $book['image'] = $image;
        }
        $book = Book::create($book);
        return new JsonResource($book);
    }
}
