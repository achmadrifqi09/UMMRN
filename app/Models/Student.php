<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    public function member(){
        return $this->belongsTo(MemberOfProject::class);
    }
    
    public function community(){
        return $this->belongsToMany(MemberOfCommunity::class);
    }
    
}
