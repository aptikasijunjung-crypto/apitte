<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pengaturan extends Model
{
    use HasFactory, Notifiable;
    protected $table = "pengaturan";
    protected $guarded = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'host_tte',
    ];
}
