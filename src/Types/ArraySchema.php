<?php

namespace BasilLangevin\LaravelDataSchemas\Types;

use BasilLangevin\LaravelDataSchemas\Enums\DataType;
use BasilLangevin\LaravelDataSchemas\Keywords\DefaultKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\DescriptionKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\FormatKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\TitleKeyword;

class ArraySchema extends Schema
{
    public static DataType $type = DataType::Array;

    public static array $keywords = [
        TitleKeyword::class,
        DescriptionKeyword::class,
        FormatKeyword::class,
        DefaultKeyword::class,
    ];
}
