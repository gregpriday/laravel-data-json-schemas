<?php

namespace BasilLangevin\LaravelDataSchemas\Types;

use BasilLangevin\LaravelDataSchemas\Enums\DataType;
use BasilLangevin\LaravelDataSchemas\Keywords\DefaultKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\DescriptionKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\FormatKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Number\ExclusiveMaximumKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Number\ExclusiveMinimumKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Number\MaximumKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Number\MinimumKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Number\MultipleOfKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\TitleKeyword;

class NumberSchema extends Schema
{
    public static DataType $type = DataType::Number;

    public static array $keywords = [
        TitleKeyword::class,
        DescriptionKeyword::class,
        FormatKeyword::class,
        DefaultKeyword::class,
        MinimumKeyword::class,
        ExclusiveMinimumKeyword::class,
        MaximumKeyword::class,
        ExclusiveMaximumKeyword::class,
        MultipleOfKeyword::class,
    ];
}
