<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rozeejob extends Model
{
    use HasFactory;
    protected $table = 'rozeejobs';

    protected $fillable = [
        'title',
        'description',
        'vacancies',
        'location',
        'min_education',
        'min_experience',
        'apply_bef',
        'url',
    ];
}