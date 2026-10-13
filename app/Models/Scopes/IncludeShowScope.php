<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Scope;
use ReflectionClass;
use ReflectionMethod;

class IncludeShowScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (empty(request('relaciones'))) {
            return;
        }

        $relations = array_filter(array_map('trim', explode(',', request('relaciones'))));
        $allowed = $this->getModelRelations($model);

        foreach ($relations as $relation) {
            if (in_array($relation, $allowed, true)) {
                $builder->with($relation);
            }
        }
    }

    protected function getModelRelations(Model $model): array
    {
        $relations = [];
        $reflection = new ReflectionClass($model);

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->isStatic() || $method->getNumberOfParameters() !== 0) {
                continue;
            }

            if ($method->getDeclaringClass()->getName() === Model::class) {
                continue;
            }

            $returnType = $method->getReturnType();
            if (! $returnType instanceof \ReflectionNamedType) {
                continue;
            }

            $typeName = $returnType->getName();
            if (is_subclass_of($typeName, Relation::class) || $typeName === Relation::class) {
                $relations[] = $method->getName();
            }
        }

        return $relations;
    }
}
