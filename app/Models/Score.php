<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'daily_test_score',
        'midterm_test_score',
        'final_test_score',
    ];


    

    // Definisikan relasi jika model ini berhubungan dengan model lain
    // Contoh: jika Score memiliki relasi dengan Student
    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }
}

