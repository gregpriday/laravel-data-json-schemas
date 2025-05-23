<?php

namespace BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators;

use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\Contracts\ConfiguresArraySchema;
use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\Contracts\ConfiguresNumberSchema;
use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\Contracts\ConfiguresObjectSchema;
use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\Contracts\ConfiguresStringSchema;
use BasilLangevin\LaravelDataJsonSchemas\Schemas\ArraySchema;
use BasilLangevin\LaravelDataJsonSchemas\Schemas\NumberSchema;
use BasilLangevin\LaravelDataJsonSchemas\Schemas\ObjectSchema;
use BasilLangevin\LaravelDataJsonSchemas\Schemas\StringSchema;
use BasilLangevin\LaravelDataJsonSchemas\Support\AttributeWrapper;
use BasilLangevin\LaravelDataJsonSchemas\Support\Contracts\EntityWrapper;
use BasilLangevin\LaravelDataJsonSchemas\Support\PropertyWrapper;

class MaxRuleConfigurator implements ConfiguresArraySchema, ConfiguresNumberSchema, ConfiguresObjectSchema, ConfiguresStringSchema
{
    public static function configureArraySchema(
        ArraySchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): ArraySchema {
        /** @var int $maxItems */
        $maxItems = $attribute->getValue();

        return $schema->maxItems($maxItems);
    }

    public static function configureNumberSchema(
        NumberSchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): NumberSchema {
        /** @var int $max */
        $max = $attribute->getValue();

        return $schema->maximum($max);
    }

    public static function configureObjectSchema(
        ObjectSchema $schema,
        EntityWrapper $entity,
        AttributeWrapper $attribute
    ): ObjectSchema {
        /** @var int $maxProperties */
        $maxProperties = $attribute->getValue();

        return $schema->maxProperties($maxProperties);
    }

    public static function configureStringSchema(
        StringSchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): StringSchema {
        /** @var int $maxLength */
        $maxLength = $attribute->getValue();

        return $schema->maxLength($maxLength);
    }
}
