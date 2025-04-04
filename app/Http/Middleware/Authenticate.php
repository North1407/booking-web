<?php
namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    protected $firebase;
    public function handle($request, Closure $next)
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}