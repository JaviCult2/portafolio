<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "users";

    protected $fillable =
        [
            "name", "last_name", "phone", "email", "user", "password", "fk_id_role"
        ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'fk_id_role');
    }
}
