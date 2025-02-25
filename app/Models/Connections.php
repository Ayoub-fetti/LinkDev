<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Connections extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
