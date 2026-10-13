<flux:page>
    <flux:heading>
        Documento: {{ $operadorDocumento->nombre }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('operador-documentos.edit', $operadorDocumento) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('operador-documentos.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->nombre }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo Documento</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->tipoDocumento?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Operador</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->operador?->nombre_juridico ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $operadorDocumento->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>