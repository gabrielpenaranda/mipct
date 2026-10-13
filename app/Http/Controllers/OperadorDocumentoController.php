<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperadorDocumentoStoreRequest;
use App\Http\Requests\OperadorDocumentoUpdateRequest;
use App\Models\OperadorDocumento;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OperadorDocumentoController extends Controller
{
    public function index()
    {
        Gate::authorize('operador-documentos.index');
        $items = OperadorDocumento::getOrPaginate();

        return view('App.operador-documentos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('operador-documentos.create');

        return view('App.operador-documentos.create');
    }

    public function store(OperadorDocumentoStoreRequest $request)
    {
        Gate::authorize('operador-documentos.store');
        $item = OperadorDocumento::create($request->validated());
        RegistroActividad::registro('operador_documentos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('operador-documentos.index')->with('success', 'Documento de operador creado correctamente.');
    }

    public function show(OperadorDocumento $operadorDocumento)
    {
        Gate::authorize('operador-documentos.show');
        $operadorDocumento = OperadorDocumento::query()->show()->findOrFail($operadorDocumento->id);

        return view('App.operador-documentos.show', compact('operadorDocumento'));
    }

    public function edit(OperadorDocumento $operadorDocumento)
    {
        Gate::authorize('operador-documentos.edit');

        return view('App.operador-documentos.edit', compact('operadorDocumento'));
    }

    public function update(OperadorDocumentoUpdateRequest $request, OperadorDocumento $operadorDocumento)
    {
        Gate::authorize('operador-documentos.update');
        $operadorDocumento->update($request->validated());
        RegistroActividad::registro('operador_documentos', 'U', $operadorDocumento->id, Auth::user()->id);

        return redirect()->route('operador-documentos.index')->with('success', 'Documento de operador actualizado correctamente.');
    }

    public function destroy(OperadorDocumento $operadorDocumento)
    {
        Gate::authorize('operador-documentos.destroy');
        try {
            $operadorDocumento->delete();
            RegistroActividad::registro('operador_documentos', 'D', $operadorDocumento->id, Auth::user()->id);

            return redirect()->route('operador-documentos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('operador-documentos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
