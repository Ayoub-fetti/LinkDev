<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'content',
        'code_snippet'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
