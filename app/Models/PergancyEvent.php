<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PergancyEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job',
    ];
}
