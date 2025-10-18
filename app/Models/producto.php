<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use Illuminate\Http\Response;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;

    protected $tabla = 'producto';
    protected $fillable =[
        'categoria_id',
        'nombre',
        'sku',
        'precio',
        'stock',
        'activo',
    ];

    public function categoria(){
        return $this->belobgsTo(Categoria::class,'categoria_id');
    }
}
