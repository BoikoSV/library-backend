<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();
            $userData = $request->all();
            $userData['password'] = 'Random password';
            $user = User::firstOrCreate(['email' => $userData['email']], $userData);
            DB::commit();
        }catch (\Exception $e){
            abort('500', 'Server error');
            DB::rollBack();
        }

        return new JsonResource($user);
    }
}
