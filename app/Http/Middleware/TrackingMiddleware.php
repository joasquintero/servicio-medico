<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tracking;

class TrackingMiddleware
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
        // dd($request->route());
        if ($request->route() !== route('welcome')) {
            if (\Auth::check()) {
                Tracking::create([
                    'user_id'       => \Auth::user()->id,
                    'action'        => 'Acceso',
                    'module'        => \URL::current(),
                    'user_rol_id'   => \Auth::user()->roles()->first()->id
                ]);
            }        
        }
        return $next($request);
    }
}
