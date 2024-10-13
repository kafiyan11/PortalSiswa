<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaMateri extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'mapel'; 

    // Menentukan primary key yang digunakan
    protected $primaryKey = 'id_mapel'; 
 
    // Menonaktifkan timestamps
    public $timestamps = false;

    // Fillable attributes
    protected $fillable = ['nama_mapel', 'icon']; // Memungkinkan mass assignment untuk nama_mapel dan icon
}
