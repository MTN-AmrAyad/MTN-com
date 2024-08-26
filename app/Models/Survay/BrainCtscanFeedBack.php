<?php

namespace App\Models\Survay;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrainCtscanFeedBack extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country_code',
        'phoneNumber',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
        'q10',
        'q11',
        'q12',
        'q13',
        'q14',
        'q15',
    ];
}
