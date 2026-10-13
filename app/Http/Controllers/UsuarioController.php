<?php

namespace App\Http\Controllers;

use App\Enums\UsuarioTipo;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\RegistroActividad;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    public function index()
    {
        Gate::authorize('usuarios.index');
        $items = User::getOrPaginate();

        return view('App.usuarios.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('usuarios.create');

        return view('App.usuarios.create');
    }

    public function store(UsuarioStoreRequest $request)
    {
        Gate::authorize('usuarios.store');

        $usuario = User::create($request->validated());

        $rol = match (true) {
            $usuario->tipo === UsuarioTipo::funcionario->value && $usuario->es_inspector => 'inspector',
            $usuario->tipo === UsuarioTipo::funcionario->value => 'funcionario',
            default => 'contribuyente',
        };
        $usuario->assignRole($rol);

        RegistroActividad::registro('users', 'C', $usuario->id, Auth::user()->id);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $usuario)
    {
        Gate::authorize('usuarios.show');
        $usuario = User::query()->show()->findOrFail($usuario->id);

        return view('App.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        Gate::authorize('usuarios.edit');

        return view('App.usuarios.edit', compact('usuario'));
    }

    public function update(UsuarioUpdateRequest $request, User $usuario)
    {
        Gate::authorize('usuarios.update');

        $usuario->update($request->validated());

        RegistroActividad::registro('users', 'U', $usuario->id, Auth::user()->id);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        Gate::authorize('usuarios.destroy');
        try {
            $usuario->syncRoles([]);
            $usuario->delete();
            RegistroActividad::registro('users', 'D', $usuario->id, Auth::user()->id);

            return redirect()->route('usuarios.index')->with('success', 'Eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('usuarios.index')->with('error', 'No se puede eliminar porque tiene registros asociados.');
            }
            throw $e;
        }
    }
}
