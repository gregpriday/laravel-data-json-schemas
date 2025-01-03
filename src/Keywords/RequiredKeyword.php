<?php

namespace BasilLangevin\LaravelDataSchemas\Keywords;

use BasilLangevin\LaravelDataSchemas\Exception\KeywordValueCouldNotBeInferred;
use BasilLangevin\LaravelDataSchemas\Transformers\ReflectionHelper;
use Illuminate\Support\Collection;
use ReflectionProperty;

class RequiredKeyword extends Keyword
{
    public function __construct(protected array $value) {}

    /**
     * Get the value of the keyword.
     */
    public function get(): array
    {
        return $this->value;
    }

    /**
     * Apply the keyword to the schema.
     */
    public function apply(Collection $schema): Collection
    {
        return $schema->merge([
            'required' => $this->get(),
        ]);
    }

    /**
     * Infer the value of the keyword from the reflector, or throw
     * an exception if the schema should not have this keyword.
     *
     * @throws KeywordValueCouldNotBeInferred
     */
    public static function parse(ReflectionHelper $reflector): array
    {
        $result = $reflector->properties()
            ->filter(function (ReflectionProperty $property) {
                $type = $property->getType();

                return $type !== null && ! $type->allowsNull();
            })
            ->map->getName()
            ->toArray();

        return $result === []
            ? throw new KeywordValueCouldNotBeInferred
            : $result;
    }
}
