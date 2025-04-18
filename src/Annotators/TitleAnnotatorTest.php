<?php

use BasilLangevin\LaravelDataJsonSchemas\Annotators\TitleAnnotator;
use BasilLangevin\LaravelDataJsonSchemas\Attributes\Title;
use BasilLangevin\LaravelDataJsonSchemas\Enums\DataType;
use BasilLangevin\LaravelDataJsonSchemas\Facades\JsonSchema;
use BasilLangevin\LaravelDataJsonSchemas\Tests\Integration\DataClasses\VehicleData;
use BasilLangevin\LaravelDataJsonSchemas\Tests\TestsSchemaTransformation;
use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;

covers(TitleAnnotator::class);

uses(TestsSchemaTransformation::class);

it('can set its title with the Title attribute')
    ->expect(fn () => $this->class->addBooleanProperty('test', [Title::class => 'This is a test title.']))
    ->toHaveSchema('test', [
        'type' => DataType::Boolean->value,
        'title' => 'This is a test title.',
    ]);

it('can set its title with a DocBlock summary on the property when the doc block has a description', function () {
    class DocBlockPropertySummaryWithDescriptionPropertyTest extends Data
    {
        public function __construct(
            /**
             * The property we're testing.
             *
             * It also has a description.
             */
            public bool $testParameter,
        ) {}
    }

    $schema = JsonSchema::make(DocBlockPropertySummaryWithDescriptionPropertyTest::class)->toArray();

    expect(Arr::get($schema, 'properties.testParameter.title'))
        ->toBe('The property we\'re testing.');
});

it('does not set its title with a DocBlock summary on the property when the doc block has no description', function () {
    class DocBlockPropertySummaryNoDescriptionTest extends Data
    {
        public function __construct(
            /** The property we're testing. */
            public bool $testParameter,
        ) {}
    }

    $schema = JsonSchema::make(DocBlockPropertySummaryNoDescriptionTest::class)->toArray();

    expect(Arr::has($schema, 'properties.testParameter.title'))
        ->toBeFalse();
});

it('does not set its title when its DocBlock does not have a summary', function () {
    class DocBlockPropertyNoSummaryTest extends Data
    {
        public function __construct(
            /** @var bool The property we're testing. */
            public bool $testParameter,
        ) {}
    }

    $schema = JsonSchema::make(DocBlockPropertyNoSummaryTest::class)->toArray();

    expect(Arr::has($schema, 'properties.testParameter.title'))
        ->toBeFalse();
});

it('can set its title with a DocBlock summary on the class when the doc block has a description', function () {
    /**
     * The class we're testing.
     *
     * It also has a description.
     */
    class DocBlockClassSummaryWithDescriptionTest extends Data
    {
        public function __construct(
            public bool $testParameter,
        ) {}
    }

    $schema = JsonSchema::make(DocBlockClassSummaryWithDescriptionTest::class)->toArray();

    expect(Arr::get($schema, 'title'))
        ->toBe('The class we\'re testing.');
});

it('does not set its title with a DocBlock summary on the class when the doc block has no description', function () {
    /** The class we're testing. */
    class DocBlockClassSummaryNoDescriptionTest extends Data
    {
        public function __construct(public bool $testParameter) {}
    }

    $schema = JsonSchema::make(DocBlockClassSummaryNoDescriptionTest::class)->toArray();

    expect(Arr::get($schema, 'title'))
        ->not->toBe('The class we\'re testing.');
});

it('does not set its title if it is a property with no annotations', function () {
    class PropertyWithNoAnnotationsTest extends Data
    {
        public function __construct(public bool $testParameter) {}
    }

    $schema = JsonSchema::make(PropertyWithNoAnnotationsTest::class)->toArray();

    expect(Arr::has($schema, 'properties.testParameter.title'))->toBeFalse();
});

it('sets the title to the class name if it is a data object with no other title annotation', function () {
    class DataObjectWithNoTitleAnnotationTest extends Data
    {
        public function __construct(public bool $testParameter) {}
    }

    $schema = JsonSchema::make(DataObjectWithNoTitleAnnotationTest::class)->toArray();

    expect(Arr::get($schema, 'title'))
        ->toBe('Data Object With No Title Annotation Test');
});

it('sets the title to the class name if it is a data object property with no other title annotation', function () {
    class DataObjectWithNoTitleAnnotationPropertyTest extends Data
    {
        public function __construct(
            public VehicleData $vehicle,
        ) {}
    }

    $schema = JsonSchema::make(DataObjectWithNoTitleAnnotationPropertyTest::class)->toArray();

    expect(Arr::get($schema, 'properties.vehicle.title'))
        ->toBe('Vehicle');
});

it('Removes the Data suffix from the class name if it is a data object and the class name ends with Data', function () {
    class DataObjectWithDataSuffixTestData extends Data
    {
        public function __construct(public bool $testParameter) {}
    }

    $schema = JsonSchema::make(DataObjectWithDataSuffixTestData::class)->toArray();

    expect(Arr::get($schema, 'title'))->toBe('Data Object With Data Suffix Test');
});
