<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use Illuminate\Http\Response;
// use App\Models\m_model;

class P_Controller extends Controller
{
    //
    public function index(Request $request)
    {
      return 'Hello, from lumen! We got your request from endpoint: ' . $request->path();
    }

    public function hello()
    {
		$data['status'] = 'Success';
		$data['message'] = 'Hello, from lumen!';
		return (new Response($data, 201))
				->header('Content-Type', 'application/json');
    }
}
