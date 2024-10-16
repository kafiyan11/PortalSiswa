<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Pastikan untuk mengimpor model User

class Score extends Model
{
    use HasFactory;


    protected $table = 'scores';

    protected $fillable = [
        'nama',
        'nis',
        'daily_test_score',
        'midterm_test_score',
        'final_test_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'nis');
    }
}
