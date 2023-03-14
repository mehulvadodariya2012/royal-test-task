<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( $request->session()->get('token') && !empty($request->session()->get('token'))){

            $url= env('API_BASE_URL').'me';

            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.Session::get('token')
            ];

            $response = Http::withHeaders($headers)->get($url);

            if($response->successful()){

                return redirect()->route('dashboard.index');
            }
        }
        return $next($request);
    }
}
