<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoPagoStoreRequest;
use App\Http\Requests\TipoPagoUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\TipoPago;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipoPagoController extends Controller
{
    public function index()
    {
        Gate::authorize('tipo-pagos.index');
        $items = TipoPago::getOrPaginate();

        return view('App.tipo-pagos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('tipo-pagos.create');

        return view('App.tipo-pagos.create');
    }

    public function store(TipoPagoStoreRequest $request)
    {
        Gate::authorize('tipo-pagos.store');
        $item = TipoPago::create($request->validated());
        RegistroActividad::registro('tipo_pagos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('tipo-pagos.index')->with('success', 'Tipo de pago creado correctamente.');
    }

    public function show(TipoPago $tipoPago)
    {
        Gate::authorize('tipo-pagos.show');
        $tipoPago = TipoPago::query()->show()->findOrFail($tipoPago->id);

        return view('App.tipo-pagos.show', compact('tipoPago'));
    }

    public function edit(TipoPago $tipoPago)
    {
        Gate::authorize('tipo-pagos.edit');

        return view('App.tipo-pagos.edit', compact('tipoPago'));
    }

    public function update(TipoPagoUpdateRequest $request, TipoPago $tipoPago)
    {
        Gate::authorize('tipo-pagos.update');
        $tipoPago->update($request->validated());
        RegistroActividad::registro('tipo_pagos', 'U', $tipoPago->id, Auth::user()->id);

        return redirect()->route('tipo-pagos.index')->with('success', 'Tipo de pago actualizado correctamente.');
    }

    public function destroy(TipoPago $tipoPago)
    {
        Gate::authorize('tipo-pagos.destroy');
        try {
            $tipoPago->delete();
            RegistroActividad::registro('tipo_pagos', 'D', $tipoPago->id, Auth::user()->id);

            return redirect()->route('tipo-pagos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('tipo-pagos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
