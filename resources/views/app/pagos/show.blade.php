<flux:page>
    <flux:heading>
        Pago: {{ $pago->numero_recibo }}
        <flux:heading.action>
            <div class="flex gap-2">
                <a href="{{ route('pagos.edit', $pago) }}" class="flux-btn flux-btn-ghost">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Editar
                </a>
                <a href="{{ route('pagos.index') }}" class="flux-btn flux-btn-ghost">
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
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->id }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Fecha</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->fecha->format('d/m/Y') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Monto</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ number_format($pago->monto, 2, ',', '.') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">N° Recibo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->numero_recibo }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Banco</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->banco?->nombre ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo de Pago</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->tipoPago?->nombre ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Creado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Actualizado</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $pago->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </flux:card>
</flux:page>