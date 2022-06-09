<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Domain extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = ['name', 'school_name'];

}
