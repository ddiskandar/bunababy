<?php

namespace App\Models;

use App\Enums\FamilyType;
use App\Support\DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;

    protected $casts = [
        'dob' => 'date',
        'type' => FamilyType::class,
    ];

    protected $appends = ['age'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getAgeAttribute()
    {
        return DateTime::calculateAge($this->dob);
    }
}
