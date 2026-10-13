<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagoStoreRequest;
use App\Http\Requests\PagoUpdateRequest;
use App\Models\Pago;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PagoController extends Controller
{
    public function index()
    {
        Gate::authorize('pagos.index');
        $items = Pago::getOrPaginate();

        return view('App.pagos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('pagos.create');

        return view('App.pagos.create');
    }

    public function store(PagoStoreRequest $request)
    {
        Gate::authorize('pagos.store');
        $item = Pago::create($request->validated());
        RegistroActividad::registro('pagos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('pagos.index')->with('success', 'Pago creado correctamente.');
    }

    public function show(Pago $pago)
    {
        Gate::authorize('pagos.show');
        $pago = Pago::query()->show()->findOrFail($pago->id);

        return view('App.pagos.show', compact('pago'));
    }

    public function edit(Pago $pago)
    {
        Gate::authorize('pagos.edit');

        return view('App.pagos.edit', compact('pago'));
    }

    public function update(PagoUpdateRequest $request, Pago $pago)
    {
        Gate::authorize('pagos.update');
        $pago->update($request->validated());
        RegistroActividad::registro('pagos', 'U', $pago->id, Auth::user()->id);

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Pago $pago)
    {
        Gate::authorize('pagos.destroy');
        try {
            $pago->delete();
            RegistroActividad::registro('pagos', 'D', $pago->id, Auth::user()->id);

            return redirect()->route('pagos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('pagos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
