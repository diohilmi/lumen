<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use App\Model\m_post;
// use Carbon\Carbon;

class PostController extends Controller
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

    public function index(Request $request){

        $jari = $request->input('jari');
    
        $hasil = 3.14*$jari*$jari;

        $response = [
            "Luas Lingkaran" => $hasil
        ];

        return $response;
    }
    //
}
