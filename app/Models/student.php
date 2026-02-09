<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = ['name','email','phone','address','status','acc_number','admission_type'];

    public function faculty(){
        return $this->belongsTo(faculty::class);
    }

    public function course_offers(){
        return $this->belongsToMany(course_offer::class);
    }
}
