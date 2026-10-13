<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoServicioStoreRequest;
use App\Http\Requests\TipoServicioUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\TipoServicio;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipoServicioController extends Controller
{
    public function index()
    {
        Gate::authorize('tipo-servicios.index');
        $items = TipoServicio::getOrPaginate();

        return view('App.tipo-servicios.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('tipo-servicios.create');

        return view('App.tipo-servicios.create');
    }

    public function store(TipoServicioStoreRequest $request)
    {
        Gate::authorize('tipo-servicios.store');
        $item = TipoServicio::create($request->validated());
        RegistroActividad::registro('tipo_servicios', 'C', $item->id, Auth::user()->id);

        return redirect()->route('tipo-servicios.index')->with('success', 'Tipo de servicio creado correctamente.');
    }

    public function show(TipoServicio $tipoServicio)
    {
        Gate::authorize('tipo-servicios.show');
        $tipoServicio = TipoServicio::query()->show()->findOrFail($tipoServicio->id);

        return view('App.tipo-servicios.show', compact('tipoServicio'));
    }

    public function edit(TipoServicio $tipoServicio)
    {
        Gate::authorize('tipo-servicios.edit');

        return view('App.tipo-servicios.edit', compact('tipoServicio'));
    }

    public function update(TipoServicioUpdateRequest $request, TipoServicio $tipoServicio)
    {
        Gate::authorize('tipo-servicios.update');
        $tipoServicio->update($request->validated());
        RegistroActividad::registro('tipo_servicios', 'U', $tipoServicio->id, Auth::user()->id);

        return redirect()->route('tipo-servicios.index')->with('success', 'Tipo de servicio actualizado correctamente.');
    }

    public function destroy(TipoServicio $tipoServicio)
    {
        Gate::authorize('tipo-servicios.destroy');
        try {
            $tipoServicio->delete();
            RegistroActividad::registro('tipo_servicios', 'D', $tipoServicio->id, Auth::user()->id);

            return redirect()->route('tipo-servicios.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('tipo-servicios.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
