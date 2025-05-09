<?php

use BasilLangevin\LaravelDataJsonSchemas\Enums\DataType;
use BasilLangevin\LaravelDataJsonSchemas\Keywords\General\ConstKeyword;
use BasilLangevin\LaravelDataJsonSchemas\Schemas\BooleanSchema;

covers(ConstKeyword::class);

$basicOutput = collect([
    'type' => DataType::Boolean->value,
]);

it('can set its const value')
    ->expect(fn () => BooleanSchema::make()->const(true))
    ->getConst()->toBe(true);

it('can apply the const value to a schema')
    ->expect(BooleanSchema::make()->const(true))
    ->applyKeyword(ConstKeyword::class, $basicOutput)
    ->toEqual(collect([
        'type' => DataType::Boolean->value,
        'const' => true,
    ]));
