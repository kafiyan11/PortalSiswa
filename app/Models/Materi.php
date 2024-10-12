<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'materi';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'judul',
        'kelas',
        'tipe',
        'gambar',
        'id_mapel',
        'link_youtube',
    ];

    /**
     * Get the Mapel that owns the Materi.
     */
    public function mapel()
    {
        return $this->belongsTo(NamaMateri::class, 'id_mapel', 'id_mapel');
    }

    public function mapell()
    {
        return $this->belongsTo(NamaMateri::class, 'icon', 'icon');
    }
}
