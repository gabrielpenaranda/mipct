<flux:page>
    <flux:heading>
        Operador: {{ $operador->nombre_juridico }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('operadores.edit', $operador) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('operadores.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Código</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->codigo }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Razón Social / Nombre</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->nombre_juridico }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo de Persona</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($operador->tipo_persona) }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Correo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->correo_empresa }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->telefono ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Número Documento</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->numero_documento }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->direccion }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Ciudad</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->ciudad?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo Documento</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->tipoDocumento?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Usuario Responsable</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->usuario?->name ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo Servicio</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->tipoServicio?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Línea de Negocio</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->lineaNegocio?->nombre ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operador->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>