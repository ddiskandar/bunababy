<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const SUCCESS_MESSAGE = 'Berhasil disimpan';
    const DELETED_MESSAGE = 'Berhasil dihapus';
    const ERROR_MESSAGE = 'Whoops! Ada Kesalahan.';
}
