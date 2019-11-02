<?php

namespace App\Http\Middleware;
use Helpers;
use Closure;

class CrawlerMiddleware
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
        
        set_time_limit(1000);
        Helpers::getWebInfo('https://www.nhaccuatui.com/',1);
        return $next($request);
    }
}
