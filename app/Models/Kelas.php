<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Kelas extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'kelas';
  	protected $fillable = ['nama'];
    protected $guarded = [];
}
