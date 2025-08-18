<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'subcategory',
        'content',
        'document_link',    
        'activity_images',  
        'image',
        'employee_id',
    ];

   
    protected $casts = [
        'activity_images' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
