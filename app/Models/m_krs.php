<?php

namespace App\Models;
// use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class m_krs extends Model 
{
    protected $table = 'krsbr';
    protected $fillable = ['id_krs', 'id_mhs', 'id_jadwal'];

}