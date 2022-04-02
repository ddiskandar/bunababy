<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function clients()
    {
        return $this->belongsToMany(User::class, 'tag_user', 'tag_id', 'client_user_id');
    }
}
