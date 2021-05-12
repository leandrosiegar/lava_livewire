<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // para poder hacer inserciones masivas
    protected $fillable = ['title', 'content', 'image'];
}
