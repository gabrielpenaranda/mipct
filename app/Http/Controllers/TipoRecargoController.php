<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoRecargoStoreRequest;
use App\Http\Requests\TipoRecargoUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\TipoRecargo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipoRecargoController extends Controller
{
    public function index()
    {
        Gate::authorize('tipo-recargos.index');
        $items = TipoRecargo::getOrPaginate();

        return view('App.tipo-recargos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('tipo-recargos.create');

        return view('App.tipo-recargos.create');
    }

    public function store(TipoRecargoStoreRequest $request)
    {
        Gate::authorize('tipo-recargos.store');
        $item = TipoRecargo::create($request->validated());
        RegistroActividad::registro('tipo_recargos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('tipo-recargos.index')->with('success', 'Tipo de recargo creado correctamente.');
    }

    public function show(TipoRecargo $tipoRecargo)
    {
        Gate::authorize('tipo-recargos.show');
        $tipoRecargo = TipoRecargo::query()->show()->findOrFail($tipoRecargo->id);

        return view('App.tipo-recargos.show', compact('tipoRecargo'));
    }

    public function edit(TipoRecargo $tipoRecargo)
    {
        Gate::authorize('tipo-recargos.edit');

        return view('App.tipo-recargos.edit', compact('tipoRecargo'));
    }

    public function update(TipoRecargoUpdateRequest $request, TipoRecargo $tipoRecargo)
    {
        Gate::authorize('tipo-recargos.update');
        $tipoRecargo->update($request->validated());
        RegistroActividad::registro('tipo_recargos', 'U', $tipoRecargo->id, Auth::user()->id);

        return redirect()->route('tipo-recargos.index')->with('success', 'Tipo de recargo actualizado correctamente.');
    }

    public function destroy(TipoRecargo $tipoRecargo)
    {
        Gate::authorize('tipo-recargos.destroy');
        try {
            $tipoRecargo->delete();
            RegistroActividad::registro('tipo_recargos', 'D', $tipoRecargo->id, Auth::user()->id);

            return redirect()->route('tipo-recargos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('tipo-recargos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
