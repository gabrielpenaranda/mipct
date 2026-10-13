<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperadorStoreRequest;
use App\Http\Requests\OperadorUpdateRequest;
use App\Models\Operador;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OperadorController extends Controller
{
    public function index()
    {
        Gate::authorize('operadores.index');
        $items = Operador::getOrPaginate();

        return view('App.operadores.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('operadores.create');

        return view('App.operadores.create');
    }

    public function store(OperadorStoreRequest $request)
    {
        Gate::authorize('operadores.store');
        $item = Operador::create($request->validated());
        RegistroActividad::registro('operadores', 'C', $item->id, Auth::user()->id);

        return redirect()->route('operadores.index')->with('success', 'Operador creado correctamente.');
    }

    public function show(Operador $operador)
    {
        Gate::authorize('operadores.show');
        $operador = Operador::query()->show()->findOrFail($operador->id);

        return view('App.operadores.show', compact('operador'));
    }

    public function edit(Operador $operador)
    {
        Gate::authorize('operadores.edit');

        return view('App.operadores.edit', compact('operador'));
    }

    public function update(OperadorUpdateRequest $request, Operador $operador)
    {
        Gate::authorize('operadores.update');
        $operador->update($request->validated());
        RegistroActividad::registro('operadores', 'U', $operador->id, Auth::user()->id);

        return redirect()->route('operadores.index')->with('success', 'Operador actualizado correctamente.');
    }

    public function destroy(Operador $operador)
    {
        Gate::authorize('operadores.destroy');
        try {
            $operador->delete();
            RegistroActividad::registro('operadores', 'D', $operador->id, Auth::user()->id);

            return redirect()->route('operadores.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('operadores.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
