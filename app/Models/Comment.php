<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    protected $fillable = ['message', 'user_id', 'post_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->attributes['created_at']);
    }
}
