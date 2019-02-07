<?php
/**
 * This class was automatically generated by GraphQL Schema generator
 */

namespace AppBundle\GraphQL;

use AppBundle\GraphQL\Types\Country\CountryType;
use AppBundle\GraphQL\Types\Country\Fields\CountriesField;
use AppBundle\GraphQL\Types\Country\Fields\CountryAddField;
use AppBundle\GraphQL\Types\Country\Fields\CountryField;
use AppBundle\GraphQL\Types\Municipality\Fields\MunicipalitiesField;
use AppBundle\GraphQL\Types\Municipality\Fields\MunicipalityField;
use AppBundle\GraphQL\Types\State\Fields\StateField;
use AppBundle\GraphQL\Types\State\Fields\StatesField;
use Youshido\GraphQL\Schema\AbstractSchema;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class Schema extends AbstractSchema
{
    public function build(SchemaConfig $config)
    {
        $config->getQuery()->addFields([
			new CountryField(),
	        new CountriesField(),
	        new StateField(),
	        new StatesField(),
	        new MunicipalityField(),
	        new MunicipalitiesField(),
            'hello' => [
                'type'    => new StringType(),
                'args'    => [
                    'name' => [
                        'type' => new StringType(),
                        'default' => 'Stranger'
                    ]
                ],
                'resolve' => function ($context, $args) {
                    return 'Hello world';
                }
            ]
        ]);
        $config->getMutation()->addFields([
                new CountryAddField(),
            ]
        );    }

}

