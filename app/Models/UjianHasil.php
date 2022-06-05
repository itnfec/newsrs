<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class UjianHasil extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'ujian_hasil';

    public function ujianSiswa()
    {
        return $this->belongsTo(UjianSiswa::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
