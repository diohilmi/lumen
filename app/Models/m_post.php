<?php

namespace App\Models;
// use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class m_post extends Model 
{
    protected $table = 'posts';
    protected $fillable = ['title', 'body'];

}
