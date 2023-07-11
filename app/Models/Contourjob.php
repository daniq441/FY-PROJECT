<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contourjob extends Model
{
    use HasFactory;
    protected $table = 'contourjobs';
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
