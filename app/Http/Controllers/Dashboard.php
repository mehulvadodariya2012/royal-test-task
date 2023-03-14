<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{

    public function index(Request $request){

        $url= env('API_BASE_URL').'authors';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if($response->successful()){

            return view('dashboard',['authors'=>json_decode($response->body())->items]);

        } else {

            $request->session()->flash('api_error', 'API Error : '.json_decode($response->body())->title);
            return view('dashboard',['authors'=>[]]);
        }

    }

    public function getAuthorBook(Request $request, $id){

        $url= env('API_BASE_URL').'authors/'.$id;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if($response->successful()){

            return view('books',['books'=>json_decode($response->body())->books]);

        } else {

            $request->session()->flash('api_error', 'API Error:- '.json_decode($response->body())->title);
            return redirect()->route('dashboard.index');
        }

    }

    /**
     * Undocumented function
     *
     * @param [type] $id //author id
     * @return void
     */
    public function deleteAuthor(Request $request, $id){

        $url= env('API_BASE_URL').'authors/'.$id;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if($response->successful()){

            $books = json_decode($response->body())->books;
            if(count($books) > 0){
                $request->session()->flash('api_error', 'Author have books so you can not delete this author');
                return redirect()->route('dashboard.index');
            }else{

                $response_delete = Http::withHeaders($headers)->delete($url);
                if($response_delete->successful()){
                    $request->session()->flash('api_success', 'Author deleted successfully');
                    return redirect()->route('dashboard.index');
                }
            }

        } else {

            $request->session()->flash('api_error', 'API Error '.json_decode($response->body())->title);
            return redirect()->route('dashboard.index');
        }

    }


    public function deleteBook(Request $request, $id){

        $url= env('API_BASE_URL').'books/'.$id;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->delete($url);

        if($response->successful()){

            $request->session()->flash('api_success', 'Book deleted successfully');
            return redirect()->route('dashboard.index');

        } else {

            $request->session()->flash('api_error', 'API Error '.json_decode($response->body())->title);
            return redirect()->route('dashboard.index');
        }

    }

    public function addBook(Request $request){

        $url= env('API_BASE_URL').'authors';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $response = Http::withHeaders($headers)->get($url);

        if($response->successful()){

            return view('bookadd',['authors'=>json_decode($response->body())->items]);

        } else {

            $request->session()->flash('api_error', 'API Error '.json_decode($response->body())->title);
            return redirect()->route('dashboard.index');
        }

    }

    public function createBook(Request $request){
        $validated = $request->validate([
            'author' => 'required',
            'title' => 'required',
            'isbn' => 'required',
            'description' => 'required',
            'number_of_pages'=>'required',
            'format' => 'required'
        ]);


        $url= env('API_BASE_URL').'books';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.Session::get('token')
        ];

        $data = [
            "author" =>  ['id'=>$request->author],
            "title" => $request->title,
            "description"=> $request->description,
            "isbn" => $request->isbn,
            "format" => $request->format,
            "number_of_pages" => (int)$request->number_of_pages,
        ];
        if($request->release_date && !empty($request->release_date)){
            $data['release_date'] = $request->release_date;
        }

        $response = Http::withHeaders($headers)->post($url,$data);
        if($response->successful()){
            $request->session()->flash('api_success', 'Book added successfully');
            return redirect()->route('author_books',$request->author);

        } else {

            $request->session()->flash('api_error', 'API error '.json_decode($response->body())->title);
            return redirect()->route('dashboard.index');
        }

    }
}
