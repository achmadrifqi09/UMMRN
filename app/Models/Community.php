<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

    public function researcher(){
        return $this->belongsTo(Researcher::class, 'id_researcher');
    }


}
