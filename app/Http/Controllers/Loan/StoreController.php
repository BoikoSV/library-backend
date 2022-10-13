<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\StoreRequest;
use App\Models\Loan;
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
        $loan = Loan::create($request->all());
        return new JsonResource($loan);
    }
}
