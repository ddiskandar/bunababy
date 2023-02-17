<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dob' => 'date'
    ];

    protected $appends = ['age'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_user_id');
    }

    public function getAgeAttribute()
    {
        return calculate_age($this->dob);
    }
}
