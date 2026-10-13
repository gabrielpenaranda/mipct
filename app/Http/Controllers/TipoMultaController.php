<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoMultaStoreRequest;
use App\Http\Requests\TipoMultaUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\TipoMulta;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipoMultaController extends Controller
{
    public function index()
    {
        Gate::authorize('tipo-multas.index');
        $items = TipoMulta::getOrPaginate();

        return view('App.tipo-multas.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('tipo-multas.create');

        return view('App.tipo-multas.create');
    }

    public function store(TipoMultaStoreRequest $request)
    {
        Gate::authorize('tipo-multas.store');
        $item = TipoMulta::create($request->validated());
        RegistroActividad::registro('tipo_multas', 'C', $item->id, Auth::user()->id);

        return redirect()->route('tipo-multas.index')->with('success', 'Tipo de multa creado correctamente.');
    }

    public function show(TipoMulta $tipoMulta)
    {
        Gate::authorize('tipo-multas.show');
        $tipoMulta = TipoMulta::query()->show()->findOrFail($tipoMulta->id);

        return view('App.tipo-multas.show', compact('tipoMulta'));
    }

    public function edit(TipoMulta $tipoMulta)
    {
        Gate::authorize('tipo-multas.edit');

        return view('App.tipo-multas.edit', compact('tipoMulta'));
    }

    public function update(TipoMultaUpdateRequest $request, TipoMulta $tipoMulta)
    {
        Gate::authorize('tipo-multas.update');
        $tipoMulta->update($request->validated());
        RegistroActividad::registro('tipo_multas', 'U', $tipoMulta->id, Auth::user()->id);

        return redirect()->route('tipo-multas.index')->with('success', 'Tipo de multa actualizado correctamente.');
    }

    public function destroy(TipoMulta $tipoMulta)
    {
        Gate::authorize('tipo-multas.destroy');
        try {
            $tipoMulta->delete();
            RegistroActividad::registro('tipo_multas', 'D', $tipoMulta->id, Auth::user()->id);

            return redirect()->route('tipo-multas.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('tipo-multas.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
