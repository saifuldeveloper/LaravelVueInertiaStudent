<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];


    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id'); 
    }
  
}
