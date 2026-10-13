@props(['model', 'route' => null, 'label' => 'Editar', 'icon' => 'pencil-square'])

@php
    $modelName = class_basename($model);
    $route = $route ?? strtolower($modelName) . '.edit';
    $item = $attributes->get('item') ?? $attributes->get('model') ?? $attributes->get('data');
@endphp

<a href="{{ route($route, $item) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300" title="{{ $label }}">
    <flux:icon :name="$icon" class="w-5 h-5" />
</a>