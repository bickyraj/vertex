<?php

namespace App\Http\Middleware;

use App\UrlRedirect as AppUrlRedirect;
use Closure;

class UrlRedirect
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
        $url_redirect = AppUrlRedirect::where('from_url', '=', $request->url())->first();
        if ($url_redirect) {
            return redirect($url_redirect->to_url);
        }
        return $next($request);
    }
}
