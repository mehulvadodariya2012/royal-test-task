<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request){

        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $url= env('API_BASE_URL').'token';
        $response = Http::post($url, [
            "email" =>  $request->username,
            "password" => $request->password
        ]);

        $userData  = json_decode($response->body());
        if($response->successful()){

            $request->session()->put(['token'=> $userData->token_key,'refresh_token_key'=> $userData->refresh_token_key,'token_expires_at'=> $userData->expires_at,'first_name'=>$userData->user->first_name,'last_name'=>$userData->user->last_name]);
            return redirect()->route('dashboard.index');

        } else {
            $request->session()->flash('api_error', 'Invalid username and password '.'('.$userData->title.')');
            return redirect()->route('home');
        }

    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function profile(Request $request){

        $url= env('API_BASE_URL').'me';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if($response->successful()){


            return view('profile',['data'=>json_decode($response->body())]);
        } else {

            $request->session()->flash('api_error', 'API Error '.json_decode($response->body())->title);
            return view('profile',['data'=>[]]);
        }

    }

}
