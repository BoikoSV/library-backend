<?php

namespace App\Http\Controllers\Book;

use App\Filters\BookFilters;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BookFilters $filters, Request $request)
    {
        if($request->has('page')){
            $books =  Book::filter($filters)->paginate();
        }else{
            $books = Book::all();
        }

        return JsonResource::collection($books);
    }
}
