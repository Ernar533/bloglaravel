<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    Use HasFactory;

    protected $table = 'post_tags';
    protected $guarded = false;
}
