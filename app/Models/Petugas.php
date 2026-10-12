<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $hidden = ['password'];

    protected $fillable = [
        'nama',
        'username',
        'password',
        'no_telepon'
    ];
}