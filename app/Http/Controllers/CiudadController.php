<?php

namespace App\Http\Controllers;

use App\Http\Requests\CiudadStoreRequest;
use App\Http\Requests\CiudadUpdateRequest;
use App\Models\Ciudad;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CiudadController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:ciudades.index', only: ['index', 'show']),
            new Middleware('permission:ciudades.create', only: ['create', 'store']),
            new Middleware('permission:ciudades.edit', only: ['edit', 'update']),
            new Middleware('permission:ciudades.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        Gate::authorize('ciudades.index');
        // $items = Ciudad::getOrPaginate();
        $items = Ciudad::paginate(10);

        return view('App.ciudades.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('ciudades.create');

        return view('App.ciudades.create');
    }

    public function store(CiudadStoreRequest $request)
    {
        Gate::authorize('ciudades.create');
        $item = Ciudad::create($request->validated());
        RegistroActividad::registro('ciudades', 'C', $item->id, Auth::user()->id);

        return redirect()->route('ciudades.index')->with('success', 'Ciudad creada correctamente.');
    }

    public function show(Ciudad $ciudad)
    {
        Gate::authorize('ciudades.show');

        return view('App.ciudades.show', compact('ciudad'));
    }

    public function edit(Ciudad $ciudad)
    {
        Gate::authorize('ciudades.edit');

        return view('App.ciudades.edit', compact('ciudad'));
    }

    public function update(CiudadUpdateRequest $request, Ciudad $ciudad)
    {
        Gate::authorize('ciudades.edit');
        $ciudad->update($request->validated());
        RegistroActividad::registro('ciudades', 'U', $ciudad->id, Auth::user()->id);

        return redirect()->route('ciudades.index')->with('success', 'Ciudad actualizada correctamente.');
    }

    public function destroy(Ciudad $ciudad)
    {
        Gate::authorize('ciudades.destroy');
        try {
            $ciudad->delete();
            RegistroActividad::registro('ciudades', 'D', $ciudad->id, Auth::user()->id);

            return redirect()->route('ciudades.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('ciudades.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
