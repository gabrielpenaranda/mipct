<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerritorioStoreRequest;
use App\Http\Requests\TerritorioUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\Territorio;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TerritorioController extends Controller
{
    public function index()
    {
        Gate::authorize('territorios.index');
        $items = Territorio::getOrPaginate();

        return view('App.territorios.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('territorios.create');

        return view('App.territorios.create');
    }

    public function store(TerritorioStoreRequest $request)
    {
        Gate::authorize('territorios.store');
        $item = Territorio::create($request->validated());
        RegistroActividad::registro('territorios', 'C', $item->id, Auth::user()->id);

        return redirect()->route('territorios.index')->with('success', 'Territorio creado correctamente.');
    }

    public function show(Territorio $territorio)
    {
        Gate::authorize('territorios.show');
        $territorio = Territorio::query()->show()->findOrFail($territorio->id);

        return view('App.territorios.show', compact('territorio'));
    }

    public function edit(Territorio $territorio)
    {
        Gate::authorize('territorios.edit');

        return view('App.territorios.edit', compact('territorio'));
    }

    public function update(TerritorioUpdateRequest $request, Territorio $territorio)
    {
        Gate::authorize('territorios.update');
        $territorio->update($request->validated());
        RegistroActividad::registro('territorios', 'U', $territorio->id, Auth::user()->id);

        return redirect()->route('territorios.index')->with('success', 'Territorio actualizado correctamente.');
    }

    public function destroy(Territorio $territorio)
    {
        Gate::authorize('territorios.destroy');
        try {
            $territorio->delete();
            RegistroActividad::registro('territorios', 'D', $territorio->id, Auth::user()->id);

            return redirect()->route('territorios.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('territorios.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
