<?php

namespace App\Http\Controllers;

use App\Models\ProductoControl;
use Illuminate\Http\Request;

class ProdutoControlController extends Controller
{
    public function index()
    {
        // Obtener todos los productos ordenados por fecha de creación descendente
        $productos = ProductoControl::orderBy('created_at', 'desc')->get();
        return view('registro_productos_control', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(ProductoControl::rules());

        // Guardar producto
        ProductoControl::create($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado con éxito');
    }

    public function create()
    {
        // Obtener productos para mostrar en la tabla
        $productos = ProductoControl::orderBy('created_at', 'desc')->get();
        return view('registro_productos_control', compact('productos'));
    }

    public function edit($id)
    {
        $producto = ProductoControl::findOrFail($id);
        return view('editar_productos_control', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = ProductoControl::findOrFail($id);
        
        $validated = $request->validate(ProductoControl::rules());
        
        $producto->update($validated);
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado con éxito');
    }

    public function destroy($id)
    {
        $producto = ProductoControl::findOrFail($id);
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado con éxito');
    }

    // Método opcional para buscar productos
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $productos = ProductoControl::where('nombre_producto', 'LIKE', "%{$query}%")
            ->orWhere('registro_ica', 'LIKE', "%{$query}%")
            ->orWhere('tipo_control', 'LIKE', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('registro_productos_control', compact('productos'));
    }
}