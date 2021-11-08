<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use GuzzleHttp\Client;
use Illuminate\Support\Str; 


class gatewayController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    public function prop()
    {
      $client = new Client();
    	$response = $client->request( 'GET', 'https://kodepos-2d475.firebaseio.com/list_propinsi.json?print=pretty');
    	$statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

    	return $body;
    }
}
