<?php

namespace App\Models;
// use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class m_mhs extends Model 
{
    protected $table = 'mhs';
    protected $fillable = ['id_krs', 'registrasi'];

}
