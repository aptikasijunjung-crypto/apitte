<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nik extends Model
{
    protected $table = "nik";

    protected $guarded = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'nik',
        'user_id',

    ];
}
