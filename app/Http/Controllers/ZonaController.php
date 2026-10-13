<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZonaStoreRequest;
use App\Http\Requests\ZonaUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\Zona;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ZonaController extends Controller
{
    public function index()
    {
        Gate::authorize('zonas.index');
        $items = Zona::getOrPaginate();

        return view('App.zonas.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('zonas.create');

        return view('App.zonas.create');
    }

    public function store(ZonaStoreRequest $request)
    {
        Gate::authorize('zonas.store');
        $item = Zona::create($request->validated());
        RegistroActividad::registro('zonas', 'C', $item->id, Auth::user()->id);

        return redirect()->route('zonas.index')->with('success', 'Zona creada correctamente.');
    }

    public function show(Zona $zona)
    {
        Gate::authorize('zonas.show');
        $zona = Zona::query()->show()->findOrFail($zona->id);

        return view('App.zonas.show', compact('zona'));
    }

    public function edit(Zona $zona)
    {
        Gate::authorize('zonas.edit');

        return view('App.zonas.edit', compact('zona'));
    }

    public function update(ZonaUpdateRequest $request, Zona $zona)
    {
        Gate::authorize('zonas.update');
        $zona->update($request->validated());
        RegistroActividad::registro('zonas', 'U', $zona->id, Auth::user()->id);

        return redirect()->route('zonas.index')->with('success', 'Zona actualizada correctamente.');
    }

    public function destroy(Zona $zona)
    {
        Gate::authorize('zonas.destroy');
        try {
            $zona->delete();
            RegistroActividad::registro('zonas', 'D', $zona->id, Auth::user()->id);

            return redirect()->route('zonas.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('zonas.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
