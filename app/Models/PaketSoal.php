<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class PaketSoal extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'paket_soal';

    protected $fillable = ['judul', 'author', 'publisher', 'level', 'point', 'jenis','kelas_id','mapel_id'];

    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
}
