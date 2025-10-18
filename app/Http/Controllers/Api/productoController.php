<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Http\Response;

class ProductoController extends Controller
{
    public function index()
    {
        //
        return Producto::query()
        ->withCount('productos')
        ->OrdeBy('id','desc')
        ->paginate(10);}

    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'sku' => 'required|string|max:50|unique:productos,sku',
            'precio' => 'required|numeric|decimal:2|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean'
        ]);
        $producto = Producto::create($data);
        return response()->json($producto, Response::HTTP_CREATED);
    }
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'nombre' => 'sometimes|required|string|max:255|unique:productos,nombre,' . $producto->id,
            'sku' => 'sometimes|required|string|max:50|unique:productos,sku,' . $producto->id,
            'precio' => 'sometimes|required|numeric|decimal:2|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'activo' => 'sometimes|boolean',
        ]);
        $producto->update($data);
        return response()->json($producto);
    }
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
