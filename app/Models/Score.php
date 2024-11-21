<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Pastikan untuk mengimpor model User

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'id_mapel',
        'daily_test_score',
        'midterm_test_score',
        'final_test_score',
    ];


    // Relasi dengan User (one to many)
    public function user()
    {
        return $this->belongsTo(User::class, 'nis', 'nis'); // nis is the foreign key in scores table
    }
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function mapel()
    {
        return $this->belongsTo(NamaMateri::class, 'id_mapel', 'id_mapel');
    }
    
}