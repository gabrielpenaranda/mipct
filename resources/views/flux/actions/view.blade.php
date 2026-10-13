@props(['model', 'route' => null, 'label' => 'Ver', 'icon' => 'eye'])

@php
    $modelName = class_basename($model);
    $route = $route ?? strtolower($modelName) . '.show';
    $item = $attributes->get('item') ?? $attributes->get('model') ?? $attributes->get('data');
@endphp

<a href="{{ route($route, $item) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="{{ $label }}">
    <flux:icon :name="$icon" class="w-5 h-5" />
</a>