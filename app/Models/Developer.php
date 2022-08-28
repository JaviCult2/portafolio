<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $table = "developers";

    protected $fillable =
        [
            "name", "last_name", "fk_id_project"
        ];
}
