<flux:page>
    <flux:heading>
        Nota de Ingreso: {{ $notaIngreso->id }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('nota-ingresos.edit', $notaIngreso) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('nota-ingresos.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Fecha Desde</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->fecha_desde->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Fecha Hasta</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->fecha_hasta->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Monto</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($notaIngreso->monto, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Banco</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->banco?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo de Pago</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->tipoPago?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Liquidación</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->liquidacionOperador?->numero_liquidacion ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $notaIngreso->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>