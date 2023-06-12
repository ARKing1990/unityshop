<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';

    protected $fillable = [
        'title',
        'caption',
        'image',
        'status',
        'created_by',
    ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
