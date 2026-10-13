<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinciaStoreRequest;
use App\Http\Requests\ProvinciaUpdateRequest;
use App\Models\Provincia;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProvinciaController extends Controller
{
    public function index()
    {
        return view('app.provincias.index');
    }

    public function create()
    {
        return view('app.provincias.create');
    }

    public function store(ProvinciaStoreRequest $request)
    {
        $item = Provincia::create($request->validated());
        RegistroActividad::registro('provincias', 'C', $item->id, Auth::user()->id);

        return redirect()->route('provincias.index')->with('success', 'Provincia creada correctamente.');
    }

    public function show(Provincia $provincia)
    {
        $provincia = Provincia::find($provincia->id)->get();

        return view('app.provincias.show', compact('provincia'));
    }

    public function edit(Provincia $provincia)
    {
        return view('app.provincias.edit', compact('provincia'));
    }

    public function update(ProvinciaUpdateRequest $request, Provincia $provincia)
    {
        $provincia->update($request->validated());
        RegistroActividad::registro('provincias', 'U', $provincia->id, Auth::user()->id);

        return redirect()->route('provincias.index')->with('success', 'Provincia actualizada correctamente.');
    }

    public function destroy(Provincia $provincia)
    {
        try {
            // elimina producto
            $provincia->delete();
            RegistroActividad::registro('provincias', 'D', $provincia->id, Auth::user()->id);

            // mensaje de exito
            Session::flash('swal', [
                'icon' => 'success',
                'title' => __('swal.exito'),
                'text' => __('swal.registroBorrado'),
            ]);
            return redirect()->route('provincias.index');

        } catch (QueryException $e) {
            // Verifica si el error es por restricción de clave foránea
            if ($e->getCode() === '23000') { // Código SQLSTATE para integridad referencial
                Session::flash('swal', [
                    'icon' => 'error',
                    'title' => __('swal.noPuedoBorrar'),
                    'text' => __('swal.registrosRelacionados'),
                ]);
                return redirect()->route('provincias.index');
            } else {
                // mensaje de error
                Session::flash('swal', [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => __('swal.error'),
                ]);
                return redirect()->route('provincias.index');
            }
            throw $e;
        }
    }
}
