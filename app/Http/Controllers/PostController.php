<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
// use Illuminate\Validation\Validator;
// use Validator;
use App\Models\m_post;
// use Illuminate\Validation\Rule;
// use Illuminate\Http\Request;
// use Carbon\Carbon;




class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // private $id;

    public function __construct()
    {
        // $this->id = $id;
        //
    }

    //projek menghitung luas lingkaran
    // public function index(Request $request){
    //     $jari = $request->input('jari');
    //     $hasil = 3.14*$jari*$jari;
    //     $response = [
    //         "Luas Lingkaran" => $hasil
    //     ];
    //     return $response;
    // }

    //projek crud sederhana
    public function index(){
        return m_post::all();
    }

    public function show($id){
        $post = m_post::find($id);
        if (! $post){
            return response()->json([
                'message' => 'post not found'
            ]);
        }
        return $post;
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
        ]);

        return m_post::create($request->all());
    }

    public function update (Request $request, $id){
        
        $post = m_post::find($id);
        
        if ($post){
            $post->update($request->all());
            return response()->json([
                'message' => 'has been updated'
            ]);
        }

        return response()->json([
            'message' => 'data not found',
            ], 404);
    }
    

    public function delete ($id){
        $post = m_post::find($id);

        if ($post){
            $post->delete();

            return response()->json([
                'message' => 'has been deleted'
            ]);

        return response()->json([
            'message' => 'post not found',
        ], 404);
        }
    }
    
}
