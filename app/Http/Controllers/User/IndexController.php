<?php

namespace App\Http\Controllers\User;

use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function __invoke(UserFilters $filters, Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->has('page')){
                $users =  User::filter($filters)->orderBy('created_at', 'desc')->paginate();
            }else{
                $users = User::all();
            }
            DB::commit();
        }catch (\Exception $e){
            abort('500', 'Server error');
            DB::rollBack();
        }
        return JsonResource::collection($users);
    }
}
