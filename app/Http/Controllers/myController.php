<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use Carbon\Carbon;

class myController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $date = Carbon::now();
        $format = 'Y-m-d H:i:s';

        $data = \DateTimeImmutable::createFromFormat($format, $date);
        
        $response = [
            "Time" => $data
        ];

         return response()->json($response, 200);
         // return Carbon::createFromFormat('Y-m-d H:i:s.u');
    }
    //
}
