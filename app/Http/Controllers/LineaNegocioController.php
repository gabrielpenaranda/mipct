<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineaNegocioStoreRequest;
use App\Http\Requests\LineaNegocioUpdateRequest;
use App\Models\LineaNegocio;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LineaNegocioController extends Controller
{
    public function index()
    {
        Gate::authorize('linea-negocios.index');
        $items = LineaNegocio::getOrPaginate();

        return view('App.linea-negocios.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('linea-negocios.create');

        return view('App.linea-negocios.create');
    }

    public function store(LineaNegocioStoreRequest $request)
    {
        Gate::authorize('linea-negocios.store');
        $item = LineaNegocio::create($request->validated());
        RegistroActividad::registro('linea_negocios', 'C', $item->id, Auth::user()->id);

        return redirect()->route('linea-negocios.index')->with('success', 'Línea de negocio creada correctamente.');
    }

    public function show(LineaNegocio $lineaNegocio)
    {
        Gate::authorize('linea-negocios.show');
        $lineaNegocio = LineaNegocio::query()->show()->findOrFail($lineaNegocio->id);

        return view('App.linea-negocios.show', compact('lineaNegocio'));
    }

    public function edit(LineaNegocio $lineaNegocio)
    {
        Gate::authorize('linea-negocios.edit');

        return view('App.linea-negocios.edit', compact('lineaNegocio'));
    }

    public function update(LineaNegocioUpdateRequest $request, LineaNegocio $lineaNegocio)
    {
        Gate::authorize('linea-negocios.update');
        $lineaNegocio->update($request->validated());
        RegistroActividad::registro('linea_negocios', 'U', $lineaNegocio->id, Auth::user()->id);

        return redirect()->route('linea-negocios.index')->with('success', 'Línea de negocio actualizada correctamente.');
    }

    public function destroy(LineaNegocio $lineaNegocio)
    {
        Gate::authorize('linea-negocios.destroy');
        try {
            $lineaNegocio->delete();
            RegistroActividad::registro('linea_negocios', 'D', $lineaNegocio->id, Auth::user()->id);

            return redirect()->route('linea-negocios.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('linea-negocios.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
