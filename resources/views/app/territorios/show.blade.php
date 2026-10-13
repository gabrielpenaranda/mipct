<flux:page>
    <flux:heading>
        Territorio: {{ $territorio->nombre }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('territorios.edit', $territorio) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('territorios.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Código</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->codigo }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->nombre }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">¿Asignado?</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->es_asignado ? 'Sí' : 'No' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->description ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Zona</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->zona?->nombre ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $territorio->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>