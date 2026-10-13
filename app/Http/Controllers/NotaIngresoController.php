<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotaIngresoStoreRequest;
use App\Http\Requests\NotaIngresoUpdateRequest;
use App\Models\NotaIngreso;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NotaIngresoController extends Controller
{
    public function index()
    {
        Gate::authorize('nota-ingresos.index');
        $items = NotaIngreso::getOrPaginate();

        return view('App.nota-ingresos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('nota-ingresos.create');

        return view('App.nota-ingresos.create');
    }

    public function store(NotaIngresoStoreRequest $request)
    {
        Gate::authorize('nota-ingresos.store');
        $item = NotaIngreso::create($request->validated());
        RegistroActividad::registro('nota_ingresos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('nota-ingresos.index')->with('success', 'Nota de ingreso creada correctamente.');
    }

    public function show(NotaIngreso $notaIngreso)
    {
        Gate::authorize('nota-ingresos.show');
        $notaIngreso = NotaIngreso::query()->show()->findOrFail($notaIngreso->id);

        return view('App.nota-ingresos.show', compact('notaIngreso'));
    }

    public function edit(NotaIngreso $notaIngreso)
    {
        Gate::authorize('nota-ingresos.edit');

        return view('App.nota-ingresos.edit', compact('notaIngreso'));
    }

    public function update(NotaIngresoUpdateRequest $request, NotaIngreso $notaIngreso)
    {
        Gate::authorize('nota-ingresos.update');
        $notaIngreso->update($request->validated());
        RegistroActividad::registro('nota_ingresos', 'U', $notaIngreso->id, Auth::user()->id);

        return redirect()->route('nota-ingresos.index')->with('success', 'Nota de ingreso actualizada correctamente.');
    }

    public function destroy(NotaIngreso $notaIngreso)
    {
        Gate::authorize('nota-ingresos.destroy');
        try {
            $notaIngreso->delete();
            RegistroActividad::registro('nota_ingresos', 'D', $notaIngreso->id, Auth::user()->id);

            return redirect()->route('nota-ingresos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('nota-ingresos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
