<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionOperadorStoreRequest;
use App\Http\Requests\LiquidacionOperadorUpdateRequest;
use App\Models\LiquidacionOperador;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LiquidacionOperadorController extends Controller
{
    public function index()
    {
        Gate::authorize('liquidacion-operadores.index');
        $items = LiquidacionOperador::getOrPaginate();

        return view('App.liquidacion-operadores.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('liquidacion-operadores.create');

        return view('App.liquidacion-operadores.create');
    }

    public function store(LiquidacionOperadorStoreRequest $request)
    {
        Gate::authorize('liquidacion-operadores.store');
        $item = LiquidacionOperador::create($request->validated());
        RegistroActividad::registro('liquidacion_operadores', 'C', $item->id, Auth::user()->id);

        return redirect()->route('liquidacion-operadores.index')->with('success', 'Liquidación de operador creada correctamente.');
    }

    public function show(LiquidacionOperador $liquidacionOperador)
    {
        Gate::authorize('liquidacion-operadores.show');
        $liquidacionOperador = LiquidacionOperador::query()->show()->findOrFail($liquidacionOperador->id);

        return view('App.liquidacion-operadores.show', compact('liquidacionOperador'));
    }

    public function edit(LiquidacionOperador $liquidacionOperador)
    {
        Gate::authorize('liquidacion-operadores.edit');

        return view('App.liquidacion-operadores.edit', compact('liquidacionOperador'));
    }

    public function update(LiquidacionOperadorUpdateRequest $request, LiquidacionOperador $liquidacionOperador)
    {
        Gate::authorize('liquidacion-operadores.update');
        $liquidacionOperador->update($request->validated());
        RegistroActividad::registro('liquidacion_operadores', 'U', $liquidacionOperador->id, Auth::user()->id);

        return redirect()->route('liquidacion-operadores.index')->with('success', 'Liquidación de operador actualizada correctamente.');
    }

    public function destroy(LiquidacionOperador $liquidacionOperador)
    {
        Gate::authorize('liquidacion-operadores.destroy');
        try {
            $liquidacionOperador->delete();
            RegistroActividad::registro('liquidacion_operadores', 'D', $liquidacionOperador->id, Auth::user()->id);

            return redirect()->route('liquidacion-operadores.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('liquidacion-operadores.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
