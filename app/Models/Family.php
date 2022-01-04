<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $casts = [
        'birt_date' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

}
