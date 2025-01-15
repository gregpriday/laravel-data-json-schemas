<?php

namespace BasilLangevin\LaravelDataSchemas\Schemas;

use BasilLangevin\LaravelDataSchemas\Enums\DataType;
use BasilLangevin\LaravelDataSchemas\Keywords\Annotation\CustomAnnotationKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Annotation\DescriptionKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Annotation\TitleKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Generic\ConstKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Generic\DefaultKeyword;
use BasilLangevin\LaravelDataSchemas\Keywords\Generic\FormatKeyword;

class ArraySchema extends Schema
{
    public static DataType $type = DataType::Array;

    public static array $keywords = [
        TitleKeyword::class,
        DescriptionKeyword::class,
        CustomAnnotationKeyword::class,
        FormatKeyword::class,
        ConstKeyword::class,
        DefaultKeyword::class,
    ];
}
