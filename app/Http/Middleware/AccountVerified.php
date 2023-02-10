<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        /** Get user id who is trying to verify */

        if (Auth::user() && !Auth::user()->email_verified_at) {
            $user_id = Auth::user()->id;

            $pageConfigs = ['blankPage' => true];
            return response()->view('/user/auth/account-verify', [
                'pageConfigs' => $pageConfigs,
                'c3f5ffa0e4b13671f15334aa066d20b9' => $user_id
            ]);

            // dd(Auth::user()->id);
            //return redirect()->route('verify.form', ['c3f5ffa0e4b13671f15334aa066d20b9' => 'Fredrick']);
            // return to_route('verify.form', ['c3f5ffa0e4b13671f15334aa066d20b9' => $user]);
        }
        return $next($request);
    }
}
