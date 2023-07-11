<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paperpkjob extends Model
{
    use HasFactory;
    protected $table = 'paperpkjobs';

    protected $fillable = [
        'title',
        'salary',
        'company',
        'vacancies',
        'apply_bef',
        'location',
        'image',
        'url',
    ];
}
