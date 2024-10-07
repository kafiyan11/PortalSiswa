<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaMateri extends Model
{
    use HasFactory;
    
    // Nama tabel
    protected $table = 'mapel';

    // Primary key
    protected $primaryKey = 'id_mapel';

    // Jika primary key bukan auto-incrementing integer, sesuaikan:
    // public $incrementing = false;
    // protected $keyType = 'string';

    // Jika tabel tidak menggunakan timestamps
    public $timestamps = false;

    // Fillable attributes
    protected $fillable = ['nama_mapel'];

}

