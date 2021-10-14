<?php

namespace App\Http\Controllers;
use App\Models\m_mhs;

class mhsController extends Controller
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
        return m_mhs::all()->where('registrasi', 0);
    }

    


    //
}
