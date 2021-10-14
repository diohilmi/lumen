<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\m_mhs;
use App\Models\m_krs;

class krsController extends Controller
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
        return m_krs::all();
    }

    public function show($id){
        $post = m_krs::find($id);
        if (! $post){
            return response()->json([
                'message' => 'post not found'
            ]);
        }
        return $post;
    }

    public function store(Request $request, $id_mhs){
        $cek = m_mhs::find($id_mhs,'id_mhs')->where('registrasi', 1)->get();
        if ($cek){
            $this->validate($request, [
                'id_krs'  => 'required',
                'id_mhs' => 'required',
                'id_jadwal'  => 'required',
            ]);
            return m_krs::create($request->all());

        } else{
            return response()->json([
                'message' => 'mahasiswa belum registrasi',
                ], 404);
        }
    }
    
    public function delete ($id){
        $post = m_krs::find($id);

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

    


    //
}
