<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";

    protected $fillable =
        [
            "name", "project_manager", "description", "enterprise"
        ];

    protected $appends =
        [
            'create',
        ];


    public function developers()
    {
        return $this->hasMany(Developer::class, 'fk_id_project');
    }

    public function getCreateAttribute(){


        return $this->created_at->format('M d Y');
    }

}
