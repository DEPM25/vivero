<?php

namespace App\Http\Controllers;

use App\Models\Labor;
use App\Models\Vivero;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    public function index(Request $request)
    {
        $viveroId = $request->get('vivero_id');
        $labores = Labor::when($viveroId, function($query) use ($viveroId) {
            return $query->where('vivero_id', $viveroId);
        })->with(['vivero.finca'])->latest()->paginate(10);
        
        $viveros = Vivero::with('finca')->get();
        return view('labores.index', compact('labores', 'viveros', 'viveroId'));
    }

    public function create()
    {
        $viveros = Vivero::with('finca')->get();
        return view('labores.create', compact('viveros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vivero_id' => 'required|exists:viveros,id',
            'fecha_realizacion' => 'required|date|before_or_equal:today',
            'descripcion' => 'required|string|max:500'
        ]);

        Labor::create($request->all());

        return redirect()->route('labores.index')
            ->with('success', 'Labor registrada exitosamente.');
    }

    public function show(Labor $labor)
    {
        return view('labores.show', compact('labor'));
    }

    public function edit(Labor $labor)
    {
        $viveros = Vivero::with('finca')->get();
        return view('labores.edit', compact('labor', 'viveros'));
    }

    public function update(Request $request, Labor $labor)
    {
        $request->validate([
            'vivero_id' => 'required|exists:viveros,id',
            'fecha_realizacion' => 'required|date|before_or_equal:today',
            'descripcion' => 'required|string|max:500'
        ]);

        $labor->update($request->all());

        return redirect()->route('labores.index')
            ->with('success', 'Labor actualizada exitosamente.');
    }

    public function destroy(Labor $labor)
    {
        $labor->delete();

        return redirect()->route('labores.index')
            ->with('success', 'Labor eliminada exitosamente.');
    }
}
