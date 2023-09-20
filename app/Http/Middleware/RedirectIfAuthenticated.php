<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($guard=='superAdmin'){

                    return redirect()->route('superAdmin.home');
                }
                if($guard=='moderator'){
                    return redirect()->route('moderator.home');
                }

                if($guard=='web' || $guard=='businessUser'){
                    if($guard=='web'){
                        if(Auth::guard('web')->user()->business_profile->approved_status==1){
                            return redirect()->route('user.home')->with('guard_name','web');
                
                            }
                    }else{
                        if(Auth::guard('businessUser')->user()->business->business_profile->approved_status==1){

                            return redirect()->route('user.home')->with('guard_name','businessUser');
                            }
                    }
                }

                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
