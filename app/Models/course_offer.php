<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_offer extends Model
{
    /** @use HasFactory<\Database\Factories\CourseOfferFactory> */
    use HasFactory;

    protected $fillable = ['section', 'max_capacity'];

    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function courses(){
        return $this->belongsTo(Course::class);
    }

    public function periods(){
        return $this->belongsTo(period::class);
    }
}
