<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Researcher extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    public function project(){
        return $this->belongsToMany(Project::class);
    }

    public function comunity(){
        return $this->belongsToMany(Project::class);
    }
    
    public function curriculumVitae(){
        return $this->hasOne(CurriculumVitae::class);
    }
}
