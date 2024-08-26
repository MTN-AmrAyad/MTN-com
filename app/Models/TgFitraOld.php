<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TgFitraOld extends Model
{
    use HasFactory;
    protected  $table = "tg_fitra";
    protected $fillable = [
        "name",
        "phone",
        "email",
        "country",
    ];
}
