<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionMultaStoreRequest;
use App\Http\Requests\LiquidacionMultaUpdateRequest;
use App\Models\LiquidacionMulta;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LiquidacionMultaController extends Controller
{
    public function index()
    {
        Gate::authorize('liquidacion-multas.index');
        $items = LiquidacionMulta::getOrPaginate();

        return view('App.liquidacion-multas.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('liquidacion-multas.create');

        return view('App.liquidacion-multas.create');
    }

    public function store(LiquidacionMultaStoreRequest $request)
    {
        Gate::authorize('liquidacion-multas.store');
        $item = LiquidacionMulta::create($request->validated());
        RegistroActividad::registro('liquidacion_multas', 'C', $item->id, Auth::user()->id);

        return redirect()->route('liquidacion-multas.index')->with('success', 'Multa de liquidación creada correctamente.');
    }

    public function show(LiquidacionMulta $liquidacionMulta)
    {
        Gate::authorize('liquidacion-multas.show');
        $liquidacionMulta = LiquidacionMulta::query()->show()->findOrFail($liquidacionMulta->id);

        return view('App.liquidacion-multas.show', compact('liquidacionMulta'));
    }

    public function edit(LiquidacionMulta $liquidacionMulta)
    {
        Gate::authorize('liquidacion-multas.edit');

        return view('App.liquidacion-multas.edit', compact('liquidacionMulta'));
    }

    public function update(LiquidacionMultaUpdateRequest $request, LiquidacionMulta $liquidacionMulta)
    {
        Gate::authorize('liquidacion-multas.update');
        $liquidacionMulta->update($request->validated());
        RegistroActividad::registro('liquidacion_multas', 'U', $liquidacionMulta->id, Auth::user()->id);

        return redirect()->route('liquidacion-multas.index')->with('success', 'Multa de liquidación actualizada correctamente.');
    }

    public function destroy(LiquidacionMulta $liquidacionMulta)
    {
        Gate::authorize('liquidacion-multas.destroy');
        try {
            $liquidacionMulta->delete();
            RegistroActividad::registro('liquidacion_multas', 'D', $liquidacionMulta->id, Auth::user()->id);

            return redirect()->route('liquidacion-multas.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('liquidacion-multas.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
