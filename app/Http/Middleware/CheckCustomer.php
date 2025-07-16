<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('customer')) {
            return redirect()->route('customer.login')->with('error', 'Anda harus login untuk melanjutkan.');
        }
        return $next($request);
    }
}