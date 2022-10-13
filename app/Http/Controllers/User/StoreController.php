<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
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
        $userData = $request->all();
        $userData['password'] = 'Random password';
        $user = User::firstOrCreate(['email' => $userData['email']], $userData);
        return new JsonResource($user);
    }
}
