<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class SoalPilihan extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'soal_pilihan';
}
