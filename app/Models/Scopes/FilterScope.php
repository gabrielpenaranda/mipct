<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $filtros = request('filtros');

        if (! is_array($filtros)) {
            $filtros = $this->parseFilterString($filtros);
        }

        if (empty($filtros)) {
            return;
        }

        foreach ($filtros as $field => $conditions) {
            if (! is_array($conditions)) {
                $this->applyFieldFilter($builder, $field, '=', $conditions);

                continue;
            }

            foreach ($conditions as $operator => $value) {
                $this->applyFieldFilter($builder, $field, $operator, $value);
            }
        }
    }

    /**
     * Apply a single field filter. If the field uses dotted notation
     * (e.g. "ciudad.nombre"), it is routed through a whereHas on the
     * matching relation so the filter is applied against the joined
     * table instead of the root one.
     */
    private function applyFieldFilter(Builder $builder, string $field, string $operator, mixed $value): void
    {
        if (! in_array($operator, ['=', '!=', '>', '<', '>=', '<=', 'like'], true)) {
            return;
        }

        if (str_contains($field, '.')) {
            [$relation, $relatedField] = explode('.', $field, 2);

            $builder->whereHas($relation, function (Builder $q) use ($relatedField, $operator, $value) {
                $q->where($relatedField, $operator, $value);
            });

            return;
        }

        $builder->where($field, $operator, $value);
    }

    /**
     * Parse a filter string like "[name][like]=Malabo" or
     * "[name][like]=Malabo&[code][=]=ABC" into the same array
     * structure PHP produces for nested query parameters.
     */
    private function parseFilterString(?string $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        $result = [];

        foreach (explode('&', $value) as $segment) {
            $segment = trim($segment);

            if ($segment === '') {
                continue;
            }

            // Find the "=" that lives outside of any brackets so the operator
            // "[=]" inside the key does not get mistaken for the separator.
            $separatorPos = $this->findTopLevelEquals($segment);

            if ($separatorPos === null) {
                continue;
            }

            $left = substr($segment, 0, $separatorPos);
            $right = substr($segment, $separatorPos + 1);

            preg_match_all('/\[([^\]]+)\]/', $left, $matches);
            $keys = $matches[1] ?? [];

            if (count($keys) === 1) {
                $result[$keys[0]] = $right;
            } elseif (count($keys) >= 2) {
                $result[$keys[0]][$keys[1]] = $right;
            }
        }

        return $result;
    }

    /**
     * Locate the first "=" character that is not wrapped inside square
     * brackets. Returns the byte offset or null when none is found.
     */
    private function findTopLevelEquals(string $segment): ?int
    {
        $depth = 0;
        $length = strlen($segment);

        for ($i = 0; $i < $length; $i++) {
            $char = $segment[$i];

            if ($char === '[') {
                $depth++;

                continue;
            }

            if ($char === ']') {
                $depth--;

                continue;
            }

            if ($char === '=' && $depth === 0) {
                return $i;
            }
        }

        return null;
    }
}
