<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class SelectShowScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if ($builder instanceof Relation) {
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

        $primaryKey = $model->getKeyName();
        if (! empty($valid) && ! in_array($primaryKey, $valid, true)) {
            array_unshift($valid, $primaryKey);
            $valid = array_values(array_unique($valid));
        }

        if (empty($valid)) {
            return;
        }

        $builder->select($valid);
    }

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
