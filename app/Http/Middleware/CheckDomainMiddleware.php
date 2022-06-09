<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Domain;
use Illuminate\Http\Request;

class CheckDomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */ 

    public function handle(Request $request, Closure $next)
    {
        $url = request()->getHttpHost();
        $domain = Domain::where('name', $url)->first(); 

        if($domain != null){
            \View::share('tenant', $domain);
        }
    
    return $next($request);
    }
}
