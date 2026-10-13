@props(['model', 'route' => null, 'label' => 'Eliminar', 'icon' => 'trash', 'confirm' => '¿Estás seguro de que quieres eliminar este registro?'])

@php
    $modelName = class_basename($model);
    $route = $route ?? strtolower($modelName) . '.destroy';
    $item = $attributes->get('item') ?? $attributes->get('model') ?? $attributes->get('data');
@endphp

<form action="{{ route($route, $item) }}" method="POST" class="inline" onsubmit="return confirm('{{ $confirm }}')">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="{{ $label }}">
        <flux:icon :name="$icon" class="w-5 h-5" />
    </button>
</form>