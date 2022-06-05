<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Mapel extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'mapel';

    protected $guarded = [];
}
