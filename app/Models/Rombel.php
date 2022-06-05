<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Rombel extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'rombel';

    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
