<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = ['name', 'nis', 'kelas', 'nohp', 'alamat', 'photo', 'parent_id'];

    // Relasi kembali ke orang tua
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id'); // Menghubungkan dengan User berdasarkan parent_id
    }
}
