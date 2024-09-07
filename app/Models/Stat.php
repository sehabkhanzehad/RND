<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $attributes = [
        "stat_value" => 0,
    ];

}
