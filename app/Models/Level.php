<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Level extends Model
{
 use HasFactory, UuidTrait;


  	protected $fillable = ['name', 'point'];
    protected $guarded = [];
    // protected $casts = ['name' => 'double'];

}
