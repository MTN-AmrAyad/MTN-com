<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RagelKasebForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_code',
        'country',
    ];
}
