<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shelf;

class Item extends Model
{
    use HasFactory;

    //Tabla SQL del Modelo
    protected $table = 'items';

    // Especificar atributos para crear un Item desde Item::create(['name' => '...']);
    protected $fillable = [
        'name',
        'amount',
        'column_start',
        'column_end',
        'row_start',
        'row_end',
        'shelf_id'
    ];
    
    // Valor por defecto de algunos atributos
    /*
       1ra     2da     
    1ra |-------|
        |       |
    2da |-------|
    */
    protected $attributes = [
        'amount' => 0,
        'column_start' => 1,
        'column_end' => 2,
        'row_start' => 1,
        'row_end' => 2,
        'shelf_id' => null
    ];

    //Relaciones
    public function shelf()
    {
        return $this->belongsTo(Shelf::class, 'shelf_id');
    }
}
