<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSetup
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
        $setup = env('SETUP');
        //echo $setup;
        if($setup == 'true'){
           // echo "setup mode";
            return $next($request);
        }
        return redirect('login');
    }
}
