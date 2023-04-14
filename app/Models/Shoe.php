<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'model', 'material', 'color', 'price', 'description', 'is_available'];

    protected function getCreatedAtAttribute($value) {
        return date('d/m/y h:i', strtotime($value));
    }

    protected function getUpdatedAtAttribute($value) {
        return date('d/m/y h:i', strtotime($value));
    }
}
