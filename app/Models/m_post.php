<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_post extends Model 
{
    protected $table = 'post';
    protected $fillable = ['title', 'body'];

}
