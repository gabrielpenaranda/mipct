<flux:page>
    <flux:heading>
        Liquidación: {{ $liquidacionOperador->numero_liquidacion }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('liquidacion-operadores.edit', $liquidacionOperador) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('liquidacion-operadores.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">N° Liquidación</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->numero_liquidacion }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Concepto</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->concepto }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Recargo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->recargo }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Multa</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->multa }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Total Concepto</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($liquidacionOperador->total_concepto, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Total Recargo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($liquidacionOperador->total_recargo, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Total Multa</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($liquidacionOperador->total_multa, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Total Liquidación</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($liquidacionOperador->total_liquidacion, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Fecha Desde</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->fecha->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Fecha Hasta</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->fecha_hasta->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">¿Pagado?</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->es_pagado ? 'Sí' : 'No' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Operador</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->operador?->nombre_juridico ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Usuario</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->usuario?->name ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $liquidacionOperador->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>