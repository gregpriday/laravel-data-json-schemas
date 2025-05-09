<?php

use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\MaxRuleConfigurator;
use BasilLangevin\LaravelDataJsonSchemas\Tests\TestsSchemaTransformation;
use Spatie\LaravelData\Attributes\Validation\Max;

covers(MaxRuleConfigurator::class);

uses(TestsSchemaTransformation::class);

it('applies the maxItems keyword to an array schema')
    ->expect(fn () => $this->class->addArrayProperty('test', [Max::class => 10]))
    ->toHaveSchema('test', [
        'type' => 'array',
        'maxItems' => 10,
    ]);

it('applies the maximum keyword to an integer schema')
    ->expect(fn () => $this->class->addIntegerProperty('test', [Max::class => 10]))
    ->toHaveSchema('test', [
        'type' => 'integer',
        'maximum' => 10,
    ]);

it('applies the maxProperties keyword to an object schema')
    ->expect(fn () => $this->class->addObjectProperty('test', [Max::class => 10]))
    ->toHaveSchema('test', [
        'type' => 'object',
        'maxProperties' => 10,
    ]);

it('applies the maxLength keyword to a string schema')
    ->expect(fn () => $this->class->addStringProperty('test', [Max::class => 10]))
    ->toHaveSchema('test', [
        'type' => 'string',
        'maxLength' => 10,
    ]);
