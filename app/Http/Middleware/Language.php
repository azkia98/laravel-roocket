<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
//        dd($request->segments());
        $local=$request->segment(1);
        if(! array_key_exists($local, config('app.locales'))){
            $segment=$request->segments();
            $segment[0]= config('app.fallback_locale');
            
            return redirect(implode('/', $segment));
        }
        
        app()->setLocale($local);
        
        return $next($request);
    }
}
