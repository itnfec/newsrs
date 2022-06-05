<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UuidTrait;

class Siswa extends Authenticatable
{
    use HasFactory, UuidTrait;

    protected $fillable = ['nama', 'nis', 'jenis_kelamin', 'rombel_id', 'password'];

    protected $table = 'siswa';

    protected $guarded = [];

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
}
