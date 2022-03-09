<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Rack;

class Shelf extends Model
{
    use HasFactory;

    // Especificar atributos para crear un modelo con asignación en masa
    protected $fillable = ['name','rows','columns'];
    
    // Valor por defecto de algunos atributos
    // Type hace referencia al tipo de estante, asignado o no asignado
    protected $attributes = [
        'type' => 0,
    ];

    //Relaciones

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
