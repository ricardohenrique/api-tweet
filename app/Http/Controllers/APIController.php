<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Storage;

class APIController extends Controller
{
    public function tweet()
    {

    	$token = $this->getToken();
    	$dataJson = collect($this->getTweet($token->token))->pluck('text');

    	dd($dataJson[0]);

    	dd($dataJson);
    	dd(get_class_methods($response->getBody()));
    }

    public function getToken()
    {
		// $client = new Client([
		//     'base_uri' => 'https://n8e480hh63o547stou3ycz5lwz0958.herokuapp.com/1.1'
		// ]);
		// $response = $client->request('POST', 'auth', []);
    	$token = '{"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoxLCJuYW1lIjoiWnVsIERpZ3RhbCJ9LCJpYXQiOjE1NDk5MzE4NzksImV4cCI6MTU0OTkzMTkzOX0.d83wbx86AK9kkO3B7Uy0cIz_SWEddSv7EwMOkcf1s_g"}';

    	return json_decode($token);
    }

    public function getTweet(string $token)
    {
    	return json_decode(file_get_contents(public_path('default.json')));
    }
}
