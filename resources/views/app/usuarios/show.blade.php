<flux:page>
    <flux:heading>
        Usuario: {{ $usuario->nombre }} {{ $usuario->apellido }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('usuarios.edit', $usuario) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('usuarios.index') }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                    Volver
                </a>
            </div>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500">ID</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->nombre }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Apellido</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->apellido }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->email }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($usuario->tipo) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Activo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->es_activo ? 'Sí' : 'No' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Ciudad</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->ciudad?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->telefono ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">N° Documento</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->numero_documento }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo Documento</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ strtoupper($usuario->tipo_documento) }}</dd>
            </div>
            @if($usuario->tipo === 'funcionario')
                <div>
                    <dt class="text-sm font-medium text-gray-500">Carnet</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $usuario->carnet ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Es Inspector</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $usuario->es_inspector ? 'Sí' : 'No' }}</dd>
                </div>
            @endif
            @if($usuario->tipo === 'contribuyente')
                <div>
                    <dt class="text-sm font-medium text-gray-500">Empresa</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $usuario->empresa ?? '—' }}</dd>
                </div>
            @endif
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->direccion }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Roles</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->getRoleNames()->implode(', ') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $usuario->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>