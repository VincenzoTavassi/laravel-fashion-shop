<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shoe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['brand', 'model', 'material', 'color', 'price', 'description', 'is_available', 'image'];

    // MUTATORS
    protected function getCreatedAtAttribute($value)
    {
        return date('d/m/y h:i', strtotime($value));
    }

    protected function getUpdatedAtAttribute($value)
    {
        return date('d/m/y h:i', strtotime($value));
    }

    //GET IMAGE
    public function getImage()
    {
        if (empty($this->image)) { // Se l'immagine è indefinita, ritorna il placeholder
            return 'https://www.grouphealth.ca/wp-content/uploads/2018/05/placeholder-image.png';
        } elseif (str_starts_with($this->image, 'http')) { // Se l'immagine è una URL ritorna la URL
            return $this->image;
        } else {
            return asset('storage/' . $this->image); // Altrimenti usa lo storage
        }
    }
}
