<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if( $request->session()->get('token') && !empty($request->session()->get('token'))){
            if ($request->session()->get('token_expires_at') && !empty($request->session()->get('token_expires_at')) && Carbon::parse($request->session()->get('token_expires_at')) < Carbon::now()) {
                // \Log::info('token expire creating new token using refresh_token_key');
                $url= env('API_BASE_URL').'token/refresh/'.($request->session()->get('refresh_token_key') ?? '');
                $headers = [
                    'Content-Type' => 'application/json',
                ];
                $response = Http::withHeaders($headers)->get($url);

                if($response->successful()){
                    // \Log::info('new token generated using refresh_token_key');
                    $userData  = json_decode($response->body());
                    $request->session()->put(['token'=> $userData->token_key,'refresh_token_key'=> $userData->refresh_token_key,'token_expires_at'=> $userData->expires_at,'first_name'=>$userData->user->first_name,'last_name'=>$userData->user->last_name]);
                } else {
                    // \Log::info('errro while generating new token using refresh_token_key');
                    $request->session()->flash('api_error', 'Unauthorize user');
                    return redirect()->route('home');
                }
            }

            return $next($request);
        }

        $request->session()->flash('api_error', 'Unauthorize user');
        return redirect()->route('home');


    }
}
