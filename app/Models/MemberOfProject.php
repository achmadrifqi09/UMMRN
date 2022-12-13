<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOfProject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function project(){
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'id_student');
    }
}
