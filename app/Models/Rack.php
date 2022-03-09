<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shelf; 

class Rack extends Model
{
    use HasFactory;
    
    // Especificar atributos para crear un modelo con asignación en masa
    protected $fillable = ['name'];
    
    //Relaciones
    public function shelves()
    {
        return $this->hasMany(Comment::class, 'foreign_key');
    }
}
