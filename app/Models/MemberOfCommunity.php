<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOfCommunity extends Model
{
    use HasFactory;
     protected $guarded = ['id'];
    
    public function community(){
        return $this->belongsTo(Community::class, 'id_community');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'id_student');
    }
}
