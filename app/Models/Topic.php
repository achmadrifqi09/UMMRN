<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function researcher(){
        return $this->belongsTo(Researcher::class, 'id_researcher');
    }

    public function student(){     
        return $this->belongsTo(Student::class, 'id_student');
    }
   
     public function comment(){
        return $this->belongsToMany(Comment::class);
    }
}
