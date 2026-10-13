<?php

namespace App\Http\Controllers;

use App\Http\Requests\BancoStoreRequest;
use App\Http\Requests\BancoUpdateRequest;
use App\Models\Banco;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BancoController extends Controller
{
    public function index()
    {
        Gate::authorize('bancos.index');
        $items = Banco::getOrPaginate();

        return view('App.bancos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('bancos.create');

        return view('App.bancos.create');
    }

    public function store(BancoStoreRequest $request)
    {
        Gate::authorize('bancos.store');
        $item = Banco::create($request->validated());
        RegistroActividad::registro('bancos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('bancos.index')->with('success', 'Banco creado correctamente.');
    }

    public function show(Banco $banco)
    {
        Gate::authorize('bancos.show');
        $banco = Banco::query()->show()->findOrFail($banco->id);

        return view('App.bancos.show', compact('banco'));
    }

    public function edit(Banco $banco)
    {
        Gate::authorize('bancos.edit');

        return view('App.bancos.edit', compact('banco'));
    }

    public function update(BancoUpdateRequest $request, Banco $banco)
    {
        Gate::authorize('bancos.update');
        $banco->update($request->validated());
        RegistroActividad::registro('bancos', 'U', $banco->id, Auth::user()->id);

        return redirect()->route('bancos.index')->with('success', 'Banco actualizado correctamente.');
    }

    public function destroy(Banco $banco)
    {
        Gate::authorize('bancos.destroy');
        try {
            $banco->delete();
            RegistroActividad::registro('bancos', 'D', $banco->id, Auth::user()->id);

            return redirect()->route('bancos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('bancos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
