<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionRecargoStoreRequest;
use App\Http\Requests\LiquidacionRecargoUpdateRequest;
use App\Models\LiquidacionRecargo;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LiquidacionRecargoController extends Controller
{
    public function index()
    {
        Gate::authorize('liquidacion-recargos.index');
        $items = LiquidacionRecargo::getOrPaginate();

        return view('App.liquidacion-recargos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('liquidacion-recargos.create');

        return view('App.liquidacion-recargos.create');
    }

    public function store(LiquidacionRecargoStoreRequest $request)
    {
        Gate::authorize('liquidacion-recargos.store');
        $item = LiquidacionRecargo::create($request->validated());
        RegistroActividad::registro('liquidacion_recargos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('liquidacion-recargos.index')->with('success', 'Recargo de liquidación creado correctamente.');
    }

    public function show(LiquidacionRecargo $liquidacionRecargo)
    {
        Gate::authorize('liquidacion-recargos.show');
        $liquidacionRecargo = LiquidacionRecargo::query()->show()->findOrFail($liquidacionRecargo->id);

        return view('App.liquidacion-recargos.show', compact('liquidacionRecargo'));
    }

    public function edit(LiquidacionRecargo $liquidacionRecargo)
    {
        Gate::authorize('liquidacion-recargos.edit');

        return view('App.liquidacion-recargos.edit', compact('liquidacionRecargo'));
    }

    public function update(LiquidacionRecargoUpdateRequest $request, LiquidacionRecargo $liquidacionRecargo)
    {
        Gate::authorize('liquidacion-recargos.update');
        $liquidacionRecargo->update($request->validated());
        RegistroActividad::registro('liquidacion_recargos', 'U', $liquidacionRecargo->id, Auth::user()->id);

        return redirect()->route('liquidacion-recargos.index')->with('success', 'Recargo de liquidación actualizado correctamente.');
    }

    public function destroy(LiquidacionRecargo $liquidacionRecargo)
    {
        Gate::authorize('liquidacion-recargos.destroy');
        try {
            $liquidacionRecargo->delete();
            RegistroActividad::registro('liquidacion_recargos', 'D', $liquidacionRecargo->id, Auth::user()->id);

            return redirect()->route('liquidacion-recargos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('liquidacion-recargos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
