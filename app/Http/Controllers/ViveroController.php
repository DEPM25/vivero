<?php

namespace App\Http\Controllers;

use App\Models\Vivero;
use App\Models\Finca;
use Illuminate\Http\Request;

class ViveroController extends Controller
{
    public function index()
    {
        $viveros = Vivero::with('finca')->get();
        return view('viveros.index', compact('viveros'));
    }

    public function create()
    {
        $fincas = Finca::all();
        return view('viveros.create', compact('fincas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:viveros,codigo',
            'tipo_cultivo' => 'required',
            'finca_id' => 'required|exists:fincas,id'
        ]);

        Vivero::create($request->all());

        return redirect()->route('viveros.index')
            ->with('success', 'Vivero registrado exitosamente.');
    }

    public function getViverosPorFinca($finca_id)
    {
        $viveros = Vivero::where('finca_id', $finca_id)->get();
        return response()->json($viveros);
    }
}
