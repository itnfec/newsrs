<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Ujian extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'ujian';
    protected $fillable = ['nama','keterangan', 'waktu_mulai', 'durasi', 'bobot', 'poin_benar', 'poin_salah', 'poin_tidak_jawab', 'tampil_hasil', 'detail_hasil', 'token', 'paket_soal_id', 'rombel_id'];
    
    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class);
    }

    public function ujianSiswa()
    {
        return $this->hasMany(UjianSiswa::class);
    }


    function checkUjian($waktuMulai): bool  {
       $now = now()->timestamp;
       $mulai = Carbon::parse($waktuMulai)->timestamp;
       
       if ($mulai > $now) {
            return false;
        }else{
            return true;
        }
    }
}
