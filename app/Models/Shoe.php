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

    public function getImageUri() {
        return $this->image ? asset('storage/' . $this->image) : 'https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png';
    }
}
