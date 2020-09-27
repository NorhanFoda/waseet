<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class CheckAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user() != null && auth()->user()->api_token_expire_date->toDateString() <= Carbon::now()->toDateString()){
            auth()->user()->update(['api_token' => null]);
            return response()->json([
                'warning' => trans('api.login_again')
            ], 400);
        }
        
        return $next($request);
    }
}
