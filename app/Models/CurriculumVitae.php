<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function researcher(){
        return $this->hasOne(Researcher::class);
    }
}
