<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\UpdateRequest;
use App\Models\Loan;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Loan $loan, UpdateRequest $request)
    {
        $loan = $loan->update($request->all());
        return $loan;
    }
}
