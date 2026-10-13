<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoStoreRequest;
use App\Http\Requests\TipoDocumentoUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\TipoDocumento;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipoDocumentoController extends Controller
{
    public function index()
    {
        Gate::authorize('tipo-documentos.index');
        $items = TipoDocumento::getOrPaginate();

        return view('App.tipo-documentos.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('tipo-documentos.create');

        return view('App.tipo-documentos.create');
    }

    public function store(TipoDocumentoStoreRequest $request)
    {
        Gate::authorize('tipo-documentos.store');
        $item = TipoDocumento::create($request->validated());
        RegistroActividad::registro('tipo_documentos', 'C', $item->id, Auth::user()->id);

        return redirect()->route('tipo-documentos.index')->with('success', 'Tipo de documento creado correctamente.');
    }

    public function show(TipoDocumento $tipoDocumento)
    {
        Gate::authorize('tipo-documentos.show');
        $tipoDocumento = TipoDocumento::query()->show()->findOrFail($tipoDocumento->id);

        return view('App.tipo-documentos.show', compact('tipoDocumento'));
    }

    public function edit(TipoDocumento $tipoDocumento)
    {
        Gate::authorize('tipo-documentos.edit');

        return view('App.tipo-documentos.edit', compact('tipoDocumento'));
    }

    public function update(TipoDocumentoUpdateRequest $request, TipoDocumento $tipoDocumento)
    {
        Gate::authorize('tipo-documentos.update');
        $tipoDocumento->update($request->validated());
        RegistroActividad::registro('tipo_documentos', 'U', $tipoDocumento->id, Auth::user()->id);

        return redirect()->route('tipo-documentos.index')->with('success', 'Tipo de documento actualizado correctamente.');
    }

    public function destroy(TipoDocumento $tipoDocumento)
    {
        Gate::authorize('tipo-documentos.destroy');
        try {
            $tipoDocumento->delete();
            RegistroActividad::registro('tipo_documentos', 'D', $tipoDocumento->id, Auth::user()->id);

            return redirect()->route('tipo-documentos.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('tipo-documentos.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
