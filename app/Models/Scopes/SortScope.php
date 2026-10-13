<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class SortScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($this->isRelationBuilder($builder)) {
            return;
        }

        if (empty(request('orden'))) {
            return;
        }

        $columns = $this->getValidColumns($model);

        $sortFields = explode(',', request('orden'));
        $direction = 'asc';

        foreach ($sortFields as $sortField) {
            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            $sortField = trim($sortField);

            if ($sortField === '' || ! in_array($sortField, $columns, true)) {
                continue;
            }

            $builder->orderBy($sortField, $direction);
        }
    }

    protected function isRelationBuilder(Builder $builder): bool
    {
        return $builder instanceof Relation;
    }

    /**
     * @return array<int, string>
     */
    protected function getValidColumns(Model $model): array
    {
        $table = $model->getTable();

        if (empty($table)) {
            return [];
        }

        try {
            return Schema::getColumnListing($table);
        } catch (\Throwable $e) {
            return [$model->getKeyName()];
        }
    }
}
