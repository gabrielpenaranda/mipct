<flux:page>
    <flux:heading>
        Concepto: {{ $liquidacionConcepto->nombre }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('liquidacion-conceptos.edit', $liquidacionConcepto) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('liquidacion-conceptos.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Código</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->codigo }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->nombre }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Monto</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($liquidacionConcepto->monto, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Línea de Negocio</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->lineaNegocio?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Categoría</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->categoria?->nombre ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->descripcion }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionConcepto->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>