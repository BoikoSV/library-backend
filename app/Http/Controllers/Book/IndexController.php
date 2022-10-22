<?php

namespace App\Http\Controllers\Book;

use App\Filters\BookFilters;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            if($request->has('page')){
                $books =  Book::filter($filters)->orderBy('created_at', 'desc')->paginate();
            }else{
                $books = Book::all();
            }
            DB::commit();
        }catch (\Exception $e){
            abort('500', 'Server error');
            DB::rollBack();
        }
        return JsonResource::collection($books);
    }
}
