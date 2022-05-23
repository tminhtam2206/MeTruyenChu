<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMod{
    public function handle(Request $request, Closure $next){
        if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'mod')){
            return $next($request);
        }
        else{
            abort(404);
        }
    }
}
