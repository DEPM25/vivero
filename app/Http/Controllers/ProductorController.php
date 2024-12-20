<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productor;

class ProductorController extends Controller
{

    // Muestra el formulario de registro
    public function showRegistroForm()
    {
         $productores = Productor::paginate(10); // Cambia 10 por el número de registros que quieras por página
        return view('productores.registro', compact('productores'));
    }

    // Procesa el registro de un nuevo productor
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
        'documento_identidad' => 'required|unique:productors|max:20',
        'nombre' => 'required|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'apellido' => 'required|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'telefono' => 'required|max:15|regex:/^([0-9]{9})$/',
        'correo' => 'required|email|unique:productors',
        ], [
        'nombre.regex' => 'El nombre solo debe contener letras',
        'apellido.regex' => 'El apellido solo debe contener letras',
        'telefono.regex' => 'El teléfono debe contener 9 dígitos numéricos'
        ]);

        // Crear nuevo productor
        Productor::create($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('productores.registro')->with('success', 'Productor registrado con éxito.');
    }
}
