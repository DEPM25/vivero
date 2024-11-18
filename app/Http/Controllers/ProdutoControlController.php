<?php

namespace App\Http\Controllers;

use App\Models\ProductoControl;
use Illuminate\Http\Request;

class ProdutoControlController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());


        $validated = $request->validate(ProductoControl::rules());

        // Guardar producto
        ProductoControl::create($validated);

        return response()->json(['message' => 'Producto registrado con éxito']);
    }

    public function create()
    {
        return view('registro_productos_control'); // Asegúrate de tener esta vista en resources/views/productos/create.blade.php
    }
}
