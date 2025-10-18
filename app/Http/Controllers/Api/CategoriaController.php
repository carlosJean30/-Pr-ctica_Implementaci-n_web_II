<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{

    public function index()
    {
        //consultar todos los registro que exiten en la tabla categorias
        return Categoria::query()
        ->withCount('productos')
        ->OrdeBy('id','desc')
        ->paginate(10);
    }

    public function store(Request $request)
    {
        //validar la data que nos envia el cliente de la tabla de categoria
        $data = $request->validate([
            'nombre'=> 'required|string|max:255|unique:categorias,nombre',
            'descripcion'=>'nullable|string|',
            'activa' => 'boolean'
        ]);

        //agregar el registro en la base de datos de la tabla de Categoria
        $categoria =Categoria::create($data);

        //devolver una respuesta
        return response()->json($categoria, Response::HTTP_CREATED);
    }

    public function show(Categoria $categoria)
    {
        //Funcion para Mostar las tablas de categoria
        return $categoria->load('productos');
    }


    public function update(Request $request,Categoria $categoria)
    {
        //Funcion para la actualizacion de la tabla de Categoria
       $data = $request->validate([
       'nombre' => 'sometimes|required|string|max:255|unique:categorias,nombre,' . $categoria->id,
       'descripcion' => 'nullable|string',
       'activa' => 'boolean'
]);


        $categoria->update($data);

        return response()->json($categoria);
    }

    public function destroy(Categoria $categoria)
    {
        //Funcion para la eliminacion de una tabla de categoria que se ha creado
        $categoria->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
