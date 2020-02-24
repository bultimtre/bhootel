<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
    return $next($request)
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
       ->header('Access-Control-Allow-Headers', 'content-type, authorization, x-requested-with');
    //   ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization');
    //   ->header('Access-Control-Allow-Headers', 'Content-Type,Authorization, X-Requested-With,X-CSRF-Token');
    //   ->header('Access-Control-Allow-Headers', 'Accept,X-Token-Auth, Content-Type,Authorization, x-requested-with,X-CSRF-Token');
  }
}
