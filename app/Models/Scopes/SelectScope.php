<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class SelectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($this->isRelationBuilder($builder)) {
            return;
        }

        if (empty(request('seleccion'))) {
            return;
        }

        $requested = array_filter(array_map('trim', explode(',', request('seleccion'))));

        if (empty($requested)) {
            return;
        }

        $columns = $this->getValidColumns($model);

        $valid = array_values(array_intersect($requested, $columns));

        if (empty($valid)) {
            return;
        }

        $builder->select($valid);
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
