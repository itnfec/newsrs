<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class PaketSoal extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'paket_soal';

    protected $fillable = ['judul', 'author', 'publisher', 'level', 'point', 'jenis','kelas_id','mapel_id', 'image', 'keterangan'];

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

        public function getImageAttribute($image)
    {
        if($image != null){
            return asset('storage/book_images/' . $image);
        }else{
            return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiQc9dZn33Wnk-j0sXZ19f8NiMZpJys7nTlA&usqp=CAU';
        }
    }
}
