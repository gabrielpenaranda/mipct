<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionConceptoStoreRequest;
use App\Http\Requests\LiquidacionConceptoUpdateRequest;
use App\Models\LiquidacionConcepto;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LiquidacionConceptoController extends Controller
{
    public function index()
    {
        Gate::authorize('liquidacion-conceptos.index');
        $items = LiquidacionConcepto::getOrPaginate();

        return view('App.liquidacion-conceptos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('liquidacion-conceptos.create');

        return view('App.liquidacion-conceptos.create');
    }

    public function store(LiquidacionConceptoStoreRequest $request)
    {
        Gate::authorize('liquidacion-conceptos.store');
        $item = LiquidacionConcepto::create($request->validated());
        RegistroActividad::registro('liquidacion_conceptos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('liquidacion-conceptos.index')->with('success', 'Concepto de liquidación creado correctamente.');
    }

    public function show(LiquidacionConcepto $liquidacionConcepto)
    {
        Gate::authorize('liquidacion-conceptos.show');
        $liquidacionConcepto = LiquidacionConcepto::query()->show()->findOrFail($liquidacionConcepto->id);

        return view('App.liquidacion-conceptos.show', compact('liquidacionConcepto'));
    }

    public function edit(LiquidacionConcepto $liquidacionConcepto)
    {
        Gate::authorize('liquidacion-conceptos.edit');

        return view('App.liquidacion-conceptos.edit', compact('liquidacionConcepto'));
    }

    public function update(LiquidacionConceptoUpdateRequest $request, LiquidacionConcepto $liquidacionConcepto)
    {
        Gate::authorize('liquidacion-conceptos.update');
        $liquidacionConcepto->update($request->validated());
        RegistroActividad::registro('liquidacion_conceptos', 'U', $liquidacionConcepto->id, Auth::user()->id);

        return redirect()->route('liquidacion-conceptos.index')->with('success', 'Concepto de liquidación actualizado correctamente.');
    }

    public function destroy(LiquidacionConcepto $liquidacionConcepto)
    {
        Gate::authorize('liquidacion-conceptos.destroy');
        try {
            $liquidacionConcepto->delete();
            RegistroActividad::registro('liquidacion_conceptos', 'D', $liquidacionConcepto->id, Auth::user()->id);

            return redirect()->route('liquidacion-conceptos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('liquidacion-conceptos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
