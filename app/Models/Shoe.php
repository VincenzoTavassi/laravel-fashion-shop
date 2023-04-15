<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

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
            return asset('storage/img/placeholder.png');
        } elseif (str_starts_with($this->image, 'http')) { // Se l'immagine è una URL ritorna la URL
            return $this->image;
        } else {
            return asset('storage/' . $this->image); // Altrimenti usa lo storage
        }
    }
}
