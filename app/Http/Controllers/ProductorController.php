<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productor;

class ProductorController extends Controller
{
    // Muestra el formulario de registro
    public function showRegistroForm()
    {
        return view('productores.registro');
    }

    // Procesa el registro de un nuevo productor
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'documento_identidad' => 'required|unique:productors|max:20',
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'telefono' => 'required|max:15',
            'correo' => 'required|email|unique:productors',
        ]);

        // Crear nuevo productor
        Productor::create($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('productores.registro')->with('success', 'Productor registrado con éxito.');
    }
}