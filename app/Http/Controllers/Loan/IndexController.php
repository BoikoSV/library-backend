<?php

namespace App\Http\Controllers\Loan;

use App\Filters\LoanFilters;
use App\Http\Controllers\Controller;
use App\Models\Loan;
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
    public function __invoke(LoanFilters $filters)
    {
        $loans = Loan::filter($filters)->orderBy('loans.created_at', 'desc')->paginate(10);
        return JsonResource::collection($loans);
    }
}
