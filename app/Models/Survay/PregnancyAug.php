<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnancyAug extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'countryCode',
        'phoneNumber',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'suggestions',
    ];
}
