<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUserLike extends Model
{
    Use HasFactory;

    protected $table = 'post_user_likes';
    protected $guarded = false;
}
