<?php

namespace BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators;

use BasilLangevin\LaravelDataJsonSchemas\RuleConfigurators\Concerns\ResolvesPropertyName;
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

class LessThanOrEqualToRuleConfigurator implements ConfiguresArraySchema, ConfiguresNumberSchema, ConfiguresObjectSchema, ConfiguresStringSchema
{
    use ResolvesPropertyName;

    public static function configureArraySchema(
        ArraySchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): ArraySchema {
        if (is_int($attribute->getValue())) {
            return $schema->maxItems($attribute->getValue());
        }

        $property = self::resolvePropertyName($attribute);

        return $schema->customAnnotation('x-less-than-or-equal-to', sprintf('The value must have at most as many items as the %s property.', $property));
    }

    public static function configureNumberSchema(
        NumberSchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): NumberSchema {
        if (is_int($attribute->getValue())) {
            return $schema->maximum($attribute->getValue());
        }

        $property = self::resolvePropertyName($attribute);

        return $schema->customAnnotation('x-less-than-or-equal-to', sprintf('The value must be less than or equal to the value of %s.', $property));
    }

    public static function configureObjectSchema(
        ObjectSchema $schema,
        EntityWrapper $entity,
        AttributeWrapper $attribute
    ): ObjectSchema {
        if (is_int($attribute->getValue())) {
            return $schema->maxProperties($attribute->getValue());
        }

        $property = self::resolvePropertyName($attribute);

        return $schema->customAnnotation('x-less-than-or-equal-to', sprintf('The value must have at most as many properties as the %s property.', $property));
    }

    public static function configureStringSchema(
        StringSchema $schema,
        PropertyWrapper $property,
        AttributeWrapper $attribute
    ): StringSchema {
        if (is_int($attribute->getValue())) {
            return $schema->maxLength($attribute->getValue());
        }

        $property = self::resolvePropertyName($attribute);

        return $schema->customAnnotation('x-less-than-or-equal-to', sprintf('The value must have at most as many characters as the value of %s.', $property));
    }
}
