<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UuidTrait;

class Siswa extends Authenticatable
{
    use HasFactory, UuidTrait;

    protected $fillable = ['nama', 'nis', 'jenis_kelamin', 'rombel_id', 'password', 'domain_id'];

    protected $table = 'siswa';

    protected $guarded = [];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function domain()
    {
        return $this->belongsTo(Domain::class,'domain_id','id');
    }
}
