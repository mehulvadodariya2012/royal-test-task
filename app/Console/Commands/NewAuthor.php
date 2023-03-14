<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class NewAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allows to create new Author from Command line';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $author['first_name'] = $this->ask('Write Author first name?');
        $author['last_name'] = $this->ask('Write Author last name?');
        $author['birthday'] = $this->ask('Author Birthday e.g. YYYY-MM-DD?');
        $author['biography'] = $this->ask('Tell me about Author Biography?');
        $author['gender'] = $this->ask('Gender?');
        $author['place_of_birth'] = $this->ask('Write Author Place of Birth?');

        $validator =  Validator::make($author, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'biography' => 'required',
            'gender' => ['required', ValidationRule::in(['male', 'female'])],
            'place_of_birth' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                $this->error($message);
            }

        }
        $apiToken = $this->ask('Please provid API Access Token.');

        //Make API Call to create Author
        $url= env('API_BASE_URL').'authors';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$apiToken
        ];

        $data = $validator->validated();

        $response = Http::withHeaders($headers)->post($url,$data);

        if($response->successful()){
            $this->info('Book added successfully');

        } else {

            $this->error('API error : something wrong'.'('.json_decode($response->body())->title.')');

        }
    }
}
