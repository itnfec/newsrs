<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Domain extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = ['id', 'name', 'school_name', 'logo',];

    public function siswa()
    {
        return $this->hasMany(Siswa::class,'id');
    }
}
